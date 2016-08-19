import RPi.GPIO as GPIO
import time
import threading
import imp
import random
import textwrap
from lights.light_system_manager import LightSystemManager
from vendingmachine.src.printer import Printer
from vendingmachine.src.coinmachine import CoinMachine

#Deprecated by LightSystemManager
from vendingmachine.src.lightingcontroller import LightingController
from vendingmachine.src.binaryboxcontroller import BinaryBoxController
from vendingmachine.src.binaryknob import BinaryKnob
from vendingmachine.src.addeventdetection import *
from logger.logger import Logger
import api.run

##-----------------------------------------------------------------------
#   Vending Machine
#
#   Main class, use this to control the vending machine.
#   Toggle the demo_mode flag to use for the burn
##-----------------------------------------------------------------------
class VendingMachine(object):
    adventure_button_pin = 18
    gift_button_pin = 16
    adventure_type_pin = 22
    box_select_pins_a = [24,26,32]
    box_select_pins_b = [36,38,40]
    out_of_service_pin = 23
    price_pins = [33,35,37]
    #Change this to False to use in the real vending machine
    #Leave as True to use the demo box with three buttons
    demo_mode = True

    print_adventures = True

    box_controller = None
    printer = None
    #deprecated by ligting system
    lighting = None
    server = None
    adventure_knob_a = None
    adventure_knob_b = None
    coin_machine = None
    logger = None

    adventure_count = 0
    gift_count = 0

    def __init__(self):
        GPIO.cleanup()
        GPIO.setmode(GPIO.BOARD)
        self.logger = Logger()
        self.__init_pins()
        self.box_controller = BinaryBoxController()
        self.printer = Printer()
        LightSystemManager.setup()
        #depracted by lighting system manager
        self.lighting = LightingController()
        self.adventure_knob_a = BinaryKnob(self.box_select_pins_a)
        self.adventure_knob_b = BinaryKnob(self.box_select_pins_b)
        self.coin_machine = CoinMachine(self.lighting, self.demo_mode)
        self.server = api.run.ServerController()

    # Private -------------------------------------------

    def __init_pins(self):
        self.logger.log("Machine: initializing pins")
        GPIO.setup(self.out_of_service_pin, GPIO.OUT)
        GPIO.setup(self.price_pins, GPIO.OUT)
        GPIO.setup(self.adventure_type_pin, GPIO.IN)
        GPIO.output(self.out_of_service_pin, True)
        GPIO.output(self.price_pins[0], True)
        GPIO.output(self.price_pins[1], True)
        GPIO.output(self.price_pins[2], True)

    def __adventure_button_cb(self, pin):
        self.logger.log("Machine: adventure button pressed with waiting status: %s" % self.waiting_to_give_adventure)
        if self.waiting_to_give_adventure == True:
            self.logger.log("  Dispensing Adventure")
            self.dispense_adventure()
            self.waiting_to_give_adventure = False
            t = threading.Timer(1.0, self.__allow_dispensing_adventures)
            t.start()

    def __allow_dispensing_adventures(self):
        self.waiting_to_give_adventure = True

    def __start_waiting_for_user(self):
        self.logger.log("Machine: waiting for user at pin %s" % self.adventure_button_pin)
        add_event_detection(self.adventure_button_pin, callback=self.__adventure_button_cb)
        add_event_detection(self.gift_button_pin, callback=self.__gift_button_pressed)

        self.__allow_dispensing_adventures()

    def __reset_box(self):
        self.box_controller.close_boxes()

    def __start_waiting_for_boxes(self):
        self.logger.log("Machine: waiting for boxes with demo mode: %s" % self.demo_mode)
        if self.demo_mode == True:
            add_event_detection(self.box_select_pins_a[0], callback=self.__box_a_pressed)
            add_event_detection(self.box_select_pins_a[1], callback=self.__box_b_pressed)
            add_event_detection(self.box_select_pins_a[2], callback=self.__box_c_pressed)


    def __box_a_pressed(self, channel):
        self.logger.log("Machine: box button a pressed")
        self.open_prize_box(1)
        self.lighting.box_selected(1)

    def __box_b_pressed(self, channel):
        self.logger.log("Machine: box button b pressed")
        self.open_prize_box(2)
        self.lighting.box_selected(2)

    def __box_c_pressed(self, channel):
        self.logger.log("Machine: box button b pressed")
        self.open_prize_box(3)
        self.lighting.box_selected(3)

    def __gift_button_pressed(self, pin):
        self.logger.log("Machine: gift Button Pressed")
        selector_a = self.adventure_knob_a.get_value()
        selector_b = self.adventure_knob_b.get_value()
        #TODO Add some logic here deciding how these two knobs pick a box
        self.logger.log("  opening box at %s" % selector_a)
        self.open_prize_box(selector_a)


    # Public --------------------------------------------

    def open_prize_box(self, box_number):
        self.logger.log("Machine: selected box %s with credits: %s" % (box_number, self.coin_machine.current_value))
        #For now, all boxes cost one. TODO: Hook this up with prices
        box_cost = 1
        if (self.coin_machine.current_value >= box_cost):
            self.logger.log("  Signalling to open box %s" % box_number)
            self.box_controller.set_box(box_number)
            #play this LED routine for opening a box
            LightSystemManager.open_box(box_number)
            self.box_controller.open_current_box()
            self.lighting.dispense_prize(box_number)
            self.gift_count = self.gift_count + 1
            self.coin_machine.subtract_coins(box_cost)
            if self.demo_mode == True:
                self.coin_machine.clear_coins()
            t = threading.Timer(5.0, self.__reset_box)
            t.start()

    def get_adventure(self):
        adventures = api.run.av_data["adventures"]
        enabled_adventures = []

        for adventure in adventures:
            if (not 'enabled' in adventure) or adventure['enabled'] == True:
                enabled_adventures.append(adventure)

        return random.choice(enabled_adventures)

    def dispense_adventure(self):
        self.logger.log("Machine: preparing to dispense adventure with printing set to: %s" % self.print_adventures)
        adventure_type = GPIO.input(self.adventure_type_pin)
        #TODO: Use the adventure type to pick an adventure
        adventure = self.get_adventure()
        self.adventure_count = self.adventure_count + 1
        if self.print_adventures == True:
            self.logger.log("  Printing adventure: %s" % adventure['id'])
            self.printer.printAdventure(adventure)
        self.lighting.dispense_adventure()

    def start(self):
        self.logger.log("Machine: starting")
        self.__start_waiting_for_boxes()
        self.__start_waiting_for_user()
        self.server.start()

    def stop(self):
        self.logger.log("Machine: stopping")
        self.server.stop()
