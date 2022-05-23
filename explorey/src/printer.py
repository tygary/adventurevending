import cups
import os
import random
from explorey.src.ExploreyQuiz import ExploreyQuiz
import threading
from logger.logger import Logger

##-----------------------------------------------------------------------
#   Printer
#
#   Printer class for printing out adventures
#   printer.printAdventure(text)
##-----------------------------------------------------------------------
class Printer(object):
    conn = cups.Connection()
    printers = conn.getPrinters()
    printer_name = printers.keys()[0]
    tmpQuizPath = "/home/pi/exploreyquiz.pdf"
    tmpBadgePath = "/home/pi/exploreybadge.pdf"
    ready_to_print = True

    logger = None

    def __init__(self):
        self.logger = Logger()

    def __print_quiz(self):
        self.logger.log("Printer: printing quiz using %s" % self.printer_name)
        self.conn.cancelAllJobs(self.printer_name)
        self.conn.printFile(self.printer_name, self.tmpQuizPath, "quiz", {})

    def __print_badge(self):
        self.logger.log("Printer: printing badge using %s" % self.printer_name)
        self.conn.cancelAllJobs(self.printer_name)
        self.conn.printFile(self.printer_name, self.tmpBadgePath, "badge", {})

    def __create_quiz(self):
        self.logger.log("Printer: creating pdf")
        try:
            os.remove(self.tmpQuizPath)
            self.logger.log("  Success")
        except OSError:
            self.logger.log("  Failure")
            pass
        title = quiz["title"].replace("\\n", "\n")
        desc = quiz["desc"].replace("\\n", "\n")

        pdf = ExploreyQuiz()
        pdf.set_margins(left=18, top=0, right=0)
        pdf.set_auto_page_break(False)

        pdf.add_page(orientation='P', format=(90,115))
        pdf.set_font('Arial', 'B', 16)
        pdf.multi_cell(0, 6, title, align='C')
        pdf.ln()
        pdf.set_font('Arial', '', 12)
        pdf.multi_cell(0, 6, desc, align='C')
        pdf.output(self.tmpQuizPath, 'F')

    def __create_badge(self):
        self.logger.log("Printer: creating pdf")
        try:
            os.remove(self.tmpBadgePath)
            self.logger.log("  Success")
        except OSError:
            self.logger.log("  Failure")
            pass
        title = quiz["title"].replace("\\n", "\n")
        desc = quiz["desc"].replace("\\n", "\n")
        grade = self.__get_random_grade()

        pdf = ExploreyQuiz()
        pdf.set_margins(left=18, top=0, right=0)
        pdf.set_auto_page_break(False)

        pdf.add_page(orientation='P', format=(90,115))
        pdf.set_font('Arial', 'B', 16)
        pdf.multi_cell(0, 6, title, align='C')
        pdf.ln()
        pdf.set_font('Arial', '', 12)
        pdf.multi_cell(0, 6, desc, align='C')
        pdf.output(self.tmpBadgePath, 'F')


    def __get_random_grade(self):
        grades = ["A+", "A", "A-", "B+", "B", "B-", "C+", "C", "C-"]
        return random.choice(grades)


    def __ready_to_print(self):
        self.logger.log("Printer: setting ready to print from %s to True" % self.ready_to_print)
        self.ready_to_print = True

    def printQuiz(self):
        self.logger.log("Printer: trying to print quiz with ready status %s" % (self.ready_to_print))
        if self.ready_to_print:
            self.__create_quiz()
            self.__print_quiz()
            self.ready_to_print = False
            t = threading.Timer(1.0, self.__ready_to_print)
            t.start()

    def printBadge(self):
        self.logger.log("Printer: trying to print badge with ready status %s" % (self.ready_to_print))
        if self.ready_to_print:
            self.__create_badge()
            self.__print_badge()
            self.ready_to_print = False
            t = threading.Timer(1.0, self.__ready_to_print)
            t.start()