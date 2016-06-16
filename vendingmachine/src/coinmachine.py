import RPi.GPIO as GPIO
from vendingmachine.src.addeventdetection import addeventdetection

##-----------------------------------------------------------------------
# Coin Machine
##-----------------------------------------------------------------------
class CoinMachine(object):
    coin_input_pin = 21
    coin_counter_input_pin = 12
    coin_counter_pins = [29,31]

    lighting = None

    waiting_for_coin = False
    accepted_a_coin = False

    coin_detected = False
    coin_counted = False
    coin_pending = False
    demo_mode = False

    current_value = 0

    def __init__(self, lighting, demo_mode=False):
        self.demo_mode = demo_mode
        self.lighting = lighting
        GPIO.setup(self.coin_counter_pins, GPIO.OUT)
        GPIO.setup(self.coin_input_pin, GPIO.IN)
        GPIO.setup(self.coin_counter_input_pin, GPIO.IN)
        self.__set_coin_count(0)
        self.start_waiting_for_coin()

    # Public --------------------------------------------

    def start_waiting_for_coin(self):
        print "waiting for coin at pin %s" % self.coin_input_pin
        add_event_detection(self.coin_input_pin, callback=self.__coin_cb)
        add_event_detection(self.coin_counter_input_pin, callback=self.__coin_counter_cb)
        self.waiting_for_coin = True

    def clear_coins(self):
        self.__set_coin_count(0)

    def subtract_coins(self, num):
        self.__set_coin_count(self.current_value - num)

    # Private -------------------------------------------

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
            self.__set_accepted_coin(True)
        else:
            print "Not accepted"
        self.coin_detected = False
        self.coin_counted = False
        self.coin_pending = False

    def __wait_for_coin(self):
        self.waiting_for_coin = True


    def __set_accepted_coin(self, value):
        self.accepted_a_coin = value;
        if value == True:
            self.lighting.coin_received()
            try:
                if self.demo_mode == True:
                    #If it's demo mode, then we should only allow 1 credit
                    self.__set_coin_count(1)
                else:
                    self.__set_coin_count(self.current_value + 1)
            except RuntimeError:
                print "Setting coin status"

    def __set_coin_count(self, count):
        #Don't allow more than three credits
        if count < 0:
            count = 0
        if count > 3:
            count = 3
        self.current_value = count
        if count == 3:
            GPIO.output(self.coin_counter_pins[0], True)
            GPIO.output(self.coin_counter_pins[1], True)
        elif count == 2:
            GPIO.output(self.coin_counter_pins[0], False)
            GPIO.output(self.coin_counter_pins[1], True)
        elif count == 1:
            GPIO.output(self.coin_counter_pins[0], True)
            GPIO.output(self.coin_counter_pins[1], False)
        else:
            GPIO.output(self.coin_counter_pins[0], False)
            GPIO.output(self.coin_counter_pins[1], False)