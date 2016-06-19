import RPi.GPIO as GPIO
import time
import threading
import serial
import imp
import random
import textwrap
from vendingmachine.src.printer import Printer
from vendingmachine.src.coinmachine import CoinMachine
from vendingmachine.src.addeventdetection import *
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

    box_controller = None
    printer = None
    lighting = None
    server = None
    adventure_knob_a = None
    adventure_knob_b = None
    coin_machine = None

    adventure_count = 0
    gift_count = 0

    def __init__(self):
        GPIO.cleanup()
        GPIO.setmode(GPIO.BOARD)
        self.__init_pins()
        self.box_controller = BinaryBoxController()
        self.printer = Printer()
        self.lighting = LightingController()
        self.adventure_knob_a = BinaryKnob(self.box_select_pins_a)
        self.adventure_knob_b = BinaryKnob(self.box_select_pins_b)
        self.coin_machine = CoinMachine(self.lighting, self.demo_mode)
        self.server = api.run.ServerController()

    # Private -------------------------------------------

    def __init_pins(self):
        GPIO.setup(self.out_of_service_pin, GPIO.OUT)
        GPIO.setup(self.price_pins, GPIO.OUT)
        GPIO.setup(self.adventure_type_pin, GPIO.IN)
        GPIO.output(self.out_of_service_pin, True)
        GPIO.output(self.price_pins[0], True)
        GPIO.output(self.price_pins[1], True)
        GPIO.output(self.price_pins[2], True)

    def __adventure_button_cb(self, pin):
        if self.waiting_to_give_adventure == True:
            print "Dispensing Adventure"
            self.dispense_adventure()
            self.waiting_to_give_adventure = False
            t = threading.Timer(1.0, self.__allow_dispensing_adventures)
            t.start()

    def __allow_dispensing_adventures(self):
        self.waiting_to_give_adventure = True

    def __start_waiting_for_user(self):
        print "waiting for user at pin %s" % self.adventure_button_pin
        add_event_detection(self.adventure_button_pin, callback=self.__adventure_button_cb)
        add_event_detection(self.gift_button_pin, callback=self.__gift_button_pressed)

        self.__allow_dispensing_adventures()

    def __reset_box(self):
        self.box_controller.close_boxes()

    def __start_waiting_for_boxes(self):
        if self.demo_mode == True:
            add_event_detection(self.box_select_pins_a[0], callback=self.__box_a_pressed)
            add_event_detection(self.box_select_pins_a[1], callback=self.__box_b_pressed)
            add_event_detection(self.box_select_pins_a[2], callback=self.__box_c_pressed)


    def __box_a_pressed(self, channel):
        print "Box button a pressed"
        self.open_prize_box(1)
        self.lighting.box_selected(1)

    def __box_b_pressed(self, channel):
        print "Box button b pressed"
        self.open_prize_box(2)
        self.lighting.box_selected(2)

    def __box_c_pressed(self, channel):
        print "Box button b pressed"
        self.open_prize_box(3)
        self.lighting.box_selected(3)

    def __gift_button_pressed(self, pin):
        print "Gift Button Pressed"
        selector_a = self.adventure_knob_a.get_value()
        selector_b = self.adventure_knob_b.get_value()
        #TODO Add some logic here deciding how these two knobs pick a box
        self.open_prize_box(selector_a)


    # Public --------------------------------------------

    def open_prize_box(self, box_number):
        print "Selected box %s" % box_number
        #For now, all boxes cost one. TODO: Hook this up with prices
        box_cost = 1
        if (self.coin_machine.current_value >= box_cost):
            self.box_controller.set_box(box_number)
            self.box_controller.open_current_box()
            self.lighting.dispense_prize(box_number)
            self.gift_count = self.gift_count + 1
            self.coin_machine.subtract_coins(box_cost)
            if self.demo_mode == True:
                self.coin_machine.clear_coins()
            print "Retrieve the prize from box %s" % box_number
            print "Gift %s" % self.gift_count
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
        adventure_type = GPIO.input(self.adventure_type_pin)
        #TODO: Use the adventure type to pick an adventure
        adventure = self.get_adventure()
        self.adventure_count = self.adventure_count + 1
        self.printer.printAdventure(adventure)
        self.lighting.dispense_adventure()
        print "Adventure #%s" % self.adventure_count

    def start(self):
        self.__start_waiting_for_boxes()
        self.__start_waiting_for_user()
        self.server.start()

    def stop(self):
        self.server.stop()


##-----------------------------------------------------------------------
#   Binary Box Controller
##-----------------------------------------------------------------------
class BinaryBoxController(object):
    binary_output_pins = [3,5,7,11]
    mux_enable_output_pins = [13,15]

    current_binary_output = [0,0,0,0]
    lower_mux_disabled = 1
    higher_mux_disabled = 1

    currently_open = False

    def __init__(self):
        GPIO.setup(self.binary_output_pins, GPIO.OUT)
        GPIO.setup(self.mux_enable_output_pins, GPIO.OUT)

        self.__set_latch(self.binary_output_pins[0], 0)
        self.__set_latch(self.binary_output_pins[1], 0)
        self.__set_latch(self.binary_output_pins[2], 0)
        self.__set_latch(self.binary_output_pins[3], 0)
        self.close_boxes()

    def set_box(self, number):
        #Change the number to counting at 0 instead of 1
        number = number - 1
        binary_num = '{0:05b}'.format(number);

        if binary_num[0] == '1':
            self.higher_mux_disabled = 0
            self.lower_mux_disabled = 1
        else:
            self.higher_mux_disabled = 1
            self.lower_mux_disabled = 0

        self.current_binary_output = [
            int(binary_num[4]),
            int(binary_num[3]),
            int(binary_num[2]),
            int(binary_num[1])]

    def open_current_box(self):
        if self.currently_open:
            self.close_boxes()

        #Set the box number
        self.__set_latch(self.binary_output_pins[0], self.current_binary_output[0])
        self.__set_latch(self.binary_output_pins[1], self.current_binary_output[1])
        self.__set_latch(self.binary_output_pins[2], self.current_binary_output[2])
        self.__set_latch(self.binary_output_pins[3], self.current_binary_output[3])

        #Enable the muxes
        self.__set_latch(self.mux_enable_output_pins[0], self.lower_mux_disabled)
        self.__set_latch(self.mux_enable_output_pins[1], self.higher_mux_disabled)


    def close_boxes(self):
        self.__set_latch(self.mux_enable_output_pins[0], 1)
        self.__set_latch(self.mux_enable_output_pins[1], 1)


    def __set_latch(self, pin, value):
        print "Setting Latch %s to %s" % (pin, value)
        try:
            GPIO.output(pin, value)
        except RuntimeError:
            print "Error setting Latch"

##-----------------------------------------------------------------------
#   Binary Knob
#
#   Controls one 3 bit binary knob with the given pins
##-----------------------------------------------------------------------
class BinaryKnob(object):
    value = 0
    pins = []

    def __init__(self, pins):
        self.pins = pins
        add_event_detection(self.pins[0], self.__handle_change, True)
        add_event_detection(self.pins[1], self.__handle_change, True)
        add_event_detection(self.pins[2], self.__handle_change, True)
        self.__handle_change

    def get_value(self):
        self.__handle_change(1)
        return self.value

    def __handle_change(self, pin):
        a = GPIO.input(self.pins[0])
        b = GPIO.input(self.pins[1])
        c = GPIO.input(self.pins[2])
        self.value = 1
        if a == True:
            self.value += 1
        if b == True:
            self.value += 2
        if c == True:
            self.value += 4
        print "Selected %s" % self.value


##-----------------------------------------------------------------------
#   Lighting Controller
#
#   Controller for communicating over serial with the lighting
#   raspberry pi.
#
#   This is the format sent over serial: "|1:12|"
#   Modes
#   1 Dispense Prize (box_number)
#   2 Coin input
#   3 Dispense Adventure
#   4 Select a box (box_number)
##-----------------------------------------------------------------------
class LightingController(object):
    conn = serial.Serial("/dev/ttyAMA0")
    conn.baudrate = 9600

    def __send_command(self, mode, box_number=None):
        command = ""
        if (box_number):
            command = "#%s:%s\n" % (mode, box_number)
        else:
            command = "#%s\n" % (mode)
        self.conn.write(command)
        #print command

    def dispense_prize(self, box_number):
        self.__send_command(1, box_number)

    def coin_received(self):
        self.__send_command(2)

    def dispense_adventure(self):
        self.__send_command(3)

    def box_selected(self, box_number):
        self.__send_command(4, box_number)



"""
  TODO
Support Using the Have a way to input an adventure and control which adventures you get
 - We need a Enable/Disable certain adventure  (scheduled)
 - Each adventure can only be dispensed a certain number of times

Play Sounds

Maintenance
 - Unlock all the boxes (possibly 9 at a time)
"""
