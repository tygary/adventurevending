import RPi.GPIO as GPIO
from vendingmachine.src.addeventdetection import *
from logger.logger import Logger

##-----------------------------------------------------------------------
#   Binary Knob
#
#   Controls one 3 bit binary knob with the given pins
##-----------------------------------------------------------------------
class BinaryKnob(object):
    value = 0
    pins = []
    logger = None

    def __init__(self, pins):
        self.logger = Logger()
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
        self.logger.log("Selected %s" % self.value)