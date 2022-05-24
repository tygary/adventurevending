import RPi.GPIO as GPIO
import time
import threading
import imp
import random
import textwrap
from explorey.src.printer import Printer

from explorey.src.addeventdetection import *
from logger.logger import Logger

##-----------------------------------------------------------------------
#   Vending Machine
#
#   Main class, use this to control the vending machine.
#   Toggle the demo_mode flag to use for the burn
##-----------------------------------------------------------------------
class Explorey(object):
    quiz_button_pin = 18
    badge_button_pin = 16

    #Change this to False to use in the real vending machine
    #Leave as True to use the demo box with three buttons
    demo_mode = True

    print_quizzes = True

    box_controller = None
    printer = None
    #deprecated by ligting system
    lighting = None
    server = None
    adventure_knob_a = None
    adventure_knob_b = None
    coin_machine = None
    logger = None

    quiz_count = 0
    badge_count = 0

    def __init__(self):
        GPIO.cleanup()
        GPIO.setmode(GPIO.BOARD)
        self.logger = Logger()
        self.__init_pins()
        self.printer = Printer()

    # Private -------------------------------------------

    def __init_pins(self):
        self.logger.log("Machine: initializing pins")

    def __quiz_button_cb(self, pin):
        self.logger.log("Machine: quiz button pressed with waiting status: %s" % self.waiting_to_print)
        if self.waiting_to_print == True:
            self.logger.log("  Dispensing Quiz")
            self.dispense_quiz()
            self.waiting_to_print = False
            t = threading.Timer(1.0, self.__allow_printing)
            t.start()

    def __badge_button_cb(self, pin):
            self.logger.log("Machine: badge button pressed with waiting status: %s" % self.waiting_to_print)
            if self.waiting_to_print == True:
                self.logger.log("  Dispensing Badge")
                self.dispense_badge()
                self.waiting_to_print = False
                t = threading.Timer(1.0, self.__allow_printing)
                t.start()

    def __allow_printing(self):
        self.waiting_to_print = True

    def __start_waiting_for_user(self):
        self.logger.log("Machine: waiting for user at pin %s" % self.quiz_button_pin)
        add_event_detection(self.quiz_button_pin, callback=self.__quiz_button_cb)
        add_event_detection(self.badge_button_pin, callback=self.__badge_button_cb)
        self.__allow_printing()


    # Public --------------------------------------------
    def dispense_quiz(self):
        self.logger.log("Machine: preparing to dispense quiz with printing set to: %s" % self.print_quizzes)
#         adventure = self.get_adventure()
        self.quiz_count = self.quiz_count + 1
        if self.print_quizzes == True:
            self.printer.printQuiz()

    def dispense_badge(self):
            self.logger.log("Machine: preparing to dispense quiz with printing set to: %s" % self.print_quizzes)
    #         adventure = self.get_adventure()
            self.badge_count = self.badge_count + 1
            if self.print_quizzes == True:
                self.printer.printBadge()

    def start(self):
        self.logger.log("Machine: starting")
        self.__start_waiting_for_user()

    def stop(self):
        self.logger.log("Machine: stopping")
