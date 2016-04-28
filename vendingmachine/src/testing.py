import RPi.GPIO as GPIO
import time
import threading
import cups
import os
import serial
import imp
import random

class VendingMachine(object):
    active_ouput_pins = []
    active_input_pins = [24]
    adventure_button_pin = 12
    coin_input_pin = 16
    coin_counter_input_pin = 18
    coin_enable_pin = 19
    coin_status_pin = 26
    box_select_pins = [22,24]
    waiting_for_coin = False
    accepted_a_coin = False

    coin_detected = False
    coin_counted = False
    coin_pending = False

    box_controller = None
    printer = None
    lighting = None
    server = None

    def __init__(self):
        GPIO.cleanup()
        GPIO.setmode(GPIO.BOARD)
        self.__init_pins()
        self.box_controller = BinaryBoxController()
        self.printer = Printer()
        self.lighting = LightingController()
        self.__set_accepted_coin(False)
        self.server = imp.load_source("run", "/home/pi/adventurevending/av-api/run.py")

        
    # Private -------------------------------------------

    def __init_pins(self):
        GPIO.setup(self.coin_status_pin, GPIO.OUT)
        GPIO.setup(self.coin_enable_pin, GPIO.OUT)
        GPIO.setup(self.coin_input_pin, GPIO.IN)
        GPIO.setup(self.coin_counter_input_pin, GPIO.IN)
        GPIO.setup(self.box_select_pins, GPIO.IN)
        GPIO.setup(self.adventure_button_pin, GPIO.IN)

    def __adventure_button_cb(self, pin):
        if self.waiting_to_give_adventure == True:
            self.dispense_adventure()
            self.waiting_to_give_adventure = False
            t = threading.Timer(1.0, self.__allow_dispensing_adventures)
            t.start()

    def __allow_dispensing_adventures(self):
        self.waiting_to_give_adventure = True
        
    def __start_waiting_for_user(self):
        print "waiting for user at pin %s" % self.adventure_button_pin
        self.__add_event_detection(self.adventure_button_pin, callback=self.__adventure_button_cb)
        self.__allow_dispensing_adventures()

    def __coin_cb(self, channel):
        if self.waiting_for_coin == True:
            print "coin slot triggered"
            self.__coin_detected()
            self.coin_detected = True

    def __coin_counter_cb(self, channel):
        if self.waiting_for_coin == True:
            print "Coin Counter triggered"
            self.__coin_detected()
            self.coin_counted = True

    def __coin_detected(self):
        if (self.coin_pending == False):
            self.coin_pending = True
            self.coin_detected = False
            self.coin_counted = False
            t = threading.Timer(1.0, self.__done_waiting_for_coin)
            t.start()

    def __done_waiting_for_coin(self):
        self.coin_detected = True
        #Fake the coin detection for now, it's broken
        if self.coin_detected == True and self.coin_counted == True:
            print "Got a coin, Pick a box"
            self.__deny_coins()
            self.__set_accepted_coin(True)
        else:
            print "Not accepted"
        self.coin_detected = False
        self.coin_counted = False
        self.coin_pending = False

    def __start_waiting_for_coin(self):
        print "waiting for coin at pin %s" % self.coin_input_pin
        self.__add_event_detection(self.coin_input_pin, callback=self.__coin_cb)
        self.__add_event_detection(self.coin_counter_input_pin, callback=self.__coin_counter_cb)
        self.__wait_for_coin()

    def __reset_box(self):
        self.box_controller.close_boxes()
        #self.__wait_for_coin()
        #t = threading.Timer(1.0, self._wait_for_coin)
        #t.start()

    def __wait_for_coin(self):
        self.waiting_for_coin = True
        GPIO.output(self.coin_enable_pin, 1)

    def __deny_coins(self):
        self.waiting_for_coin = False
        GPIO.output(self.coin_enable_pin, 0)

    def __start_waiting_for_boxes(self):
        self.__add_event_detection(self.box_select_pins[0], callback=self.__box_a_pressed)
        self.__add_event_detection(self.box_select_pins[1], callback=self.__box_b_pressed)

    def __box_a_pressed(self, channel):
        print "Box button a pressed"
        self.open_prize_box(1)
        self.lighting.box_selected(1)

    def __box_b_pressed(self, channel):
        print "Box button b pressed"
        self.open_prize_box(2)
        self.lighting.box_selected(2)

    def __set_accepted_coin(self, value):
        self.accepted_a_coin = value;
        if value == True:
            self.lighting.coin_received()
        try:
            GPIO.output(self.coin_status_pin, value)
        except RuntimeError:
            print "Setting coin status"

    def __add_event_detection(self, pin, callback):
        try:
            GPIO.setup(pin, GPIO.IN)
            GPIO.remove_event_detect(pin)
            GPIO.add_event_detect(pin, GPIO.FALLING, callback=callback)
        except RuntimeError:
            try:
                GPIO.remove_event_detect(pin)
                GPIO.add_event_detect(pin, GPIO.FALLING, callback=callback)
            except RuntimeError:
                pass

            

    # Public --------------------------------------------
 
    def open_prize_box(self, box_number):
        print "Selected box %s" % box_number
        if (self.accepted_a_coin == True):
            self.__wait_for_coin()
            self.box_controller.set_box(box_number)
            self.box_controller.open_current_box()
            self.lighting.dispense_prize(box_number)
            print "Retrieve the prize from box %s" % box_number
            t = threading.Timer(5.0, self.__reset_box)
            t.start()
            #self.box_controller.close_boxes()
        self.__set_accepted_coin(False)
        

    def dispense_adventure(self):
        arr = self.server.adventures["adventures"]
        adventure = random.choice(arr)
        text = "%s\n%s" % (adventure["title"], adventure["desc"])
        self.printer.printAdventure(text)
        self.lighting.dispense_adventure()

    def start(self):
        self.__start_waiting_for_coin()
        self.__start_waiting_for_boxes()
        self.__start_waiting_for_user()


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


class Printer(object):
    conn = cups.Connection()
    printers = conn.getPrinters()
    printer_name = printers.keys()[0]
    tmpfilePath = "/home/pi/tmpadventure"

    def __print(self):
        self.conn.printFile(self.printer_name, self.tmpfilePath, "adventure", {})

    def __create_file(self, text):
        try:
            os.remove(self.tmpfilePath)
        except OSError:
            pass
        f = open(self.tmpfilePath, 'w')
        f.write(text)
        f.close()

    def printAdventure(self, text):
        self.__create_file(text)
        self.__print()


"|1:12|"
#Modes
#1 Dispense Prize (box_number)
#2 Coin input
#3 Dispense Adventure
#4 Select a box (box_number)

class LightingController(object):
    conn = serial.Serial("/dev/ttyAMA0")
    conn.baudrate = 9600

    def __send_command(self, mode, box_number=None):
        command = ""
        if (box_number):
            command = "#%s:%s\n" % (mode, box_number)
        else:
            command = "#%s\n" % (mode)
        #self.conn.write(command)
        #print command

    def dispense_prize(self, box_number):
        self.__send_command(1, box_number)

    def coin_received(self):
        self.__send_command(2)

    def dispense_adventure(self):
        self.__send_command(3)

    def box_selected(self, box_number):
        self.__send_command(4, box_number)

machine = VendingMachine()
machine.start()


"""
  TODO
Support 27 Boxes
Support Using the Have a way to input an adventure and control which adventures you get
 - We need an easy way to input them into the machine
 - We need a Enable/Disable certain adventure  (scheduled)
 - Each adventure can only be dispensed a certain number of times
 - Build a small UI to control the adventures

Control the Lighting

Play Sounds

Maintenance
 - Unlock all the boxes (possibly 9 at a time)
"""
