import serial

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