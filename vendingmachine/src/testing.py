import RPi.GPIO as GPIO
import time


class VendingMachine(object):
    active_ouput_pins = [18]
    active_input_pins = [2]
    adventure_button_pin = 6
    coin_input_pin = 7

    def __init__(self):
        self.__init_pins()
        self.__start_waiting_for_coin() 

    # Private -------------------------------------------

    def __init_pins(self):
        GPIO.setup(self.active_ouput_pins, GPIO.OUT)
        GPIO.setup(self.active_input_pins, GPIO.IN)

    def __open_box(self, box_number):
        self.__set_latch(box_number, False)

    def __close_box(self, box_number):
        self.__set_latch(box_number, True)

    def __set_latch(self, pin, value):
        GPIO.output(pin, value)
        print "Setting Latch %s to %s" % pin, value

    def __adventure_button_cb(self):
        self.dispense_adventure()

    def __start_waiting_for_user(self):
        GPIO.add_event_detect(self.adventure_button_pin, GPIO.RISING, callback=self.__adventure_button_cb)

    def __coin_cb(self):
        print "Got a coin, opening box 1"

        self.open_prize_box(1)


    def __start_waiting_for_coin(self): 
        GPIO.add_event_detect(self.coin_input_pin, GPIO.FALLING, callback=self.__coin_cb)

    # Public --------------------------------------------

    def open_prize_box(self, box_number):
        self.__open_box(box_number)
        print "Retrieve the prize from box %s" % box_number
        time.sleep(5)
        self.__close_box(box_number)

    def dispense_adventure(self):
        print "Here's an adventure!"
