from fpdf import FPDF

##-----------------------------------------------------------------------
#   Logger
#
#   Basic PDF format for making an adventure
##-----------------------------------------------------------------------
class Logger(object):
    def log(self, message):
        print message