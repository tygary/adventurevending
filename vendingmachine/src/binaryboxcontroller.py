import RPi.GPIO as GPIO

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