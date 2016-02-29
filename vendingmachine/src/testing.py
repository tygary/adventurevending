import RPi.GPIO as GPIO
import time


class VendingMachine(object):
    active_ouput_pins = [18]
    active_input_pins = [7]
    adventure_button_pin = 6
    coin_input_pin = 7
    waiting_for_coin = 0;

    def __init__(self):
        GPIO.setmode(GPIO.BOARD)
        self.__init_pins()
        self.__close_box(18)
        
    # Private -------------------------------------------

    def __init_pins(self):
        GPIO.setup(self.active_ouput_pins, GPIO.OUT)
        GPIO.setup(7, GPIO.IN)

    def __open_box(self, box_number):
        print "open box"
        self.__set_latch(box_number, False)

    def __close_box(self, box_number):
        print "Close box"
        self.__set_latch(box_number, True)

    def __set_latch(self, pin, value):
        GPIO.output(pin, value)
        print "Setting Latch %s to %s" % (pin, value)

    def __adventure_button_cb(self):
        self.dispense_adventure()

    def __start_waiting_for_user(self):
        print "waiting for user at pin %s" % self.adventure_button_pin
        GPIO.add_event_detect(self.adventure_button_pin, GPIO.RISING, callback=self.__adventure_button_cb)

    def __coin_cb(self, channel):
        print "Got a coin, opening box 18"
        if self.waiting_for_coin == 1:
            self.waiting_for_coin = 0;
            self.open_prize_box(18)
        else:
            print "Not accepted"

    def __start_waiting_for_coin(self):
        print "waiting for coid at pin %s" % self.coin_input_pin
        GPIO.add_event_detect(self.coin_input_pin, GPIO.FALLING, callback=self.__coin_cb)
        self.waiting_for_coin = 1
        

    # Public --------------------------------------------
 
    def open_prize_box(self, box_number):
        self.__open_box(box_number)
        print "Retrieve the prize from box %s" % box_number
        time.sleep(5)
        self.__close_box(box_number)
        

    def dispense_adventure(self):
        print "Here's an adventure!"

    def start(self):
        self.__start_waiting_for_coin()

    def wait(self):
        self.waiting_for_coin = 1



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
