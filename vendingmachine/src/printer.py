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
    tmpfilePath = "/home/pi/tmpadventure.pdf"
    ready_to_print = True

    def __print(self):
        self.conn.cancelAllJobs(self.printer_name)
        self.conn.printFile(self.printer_name, self.tmpfilePath, "adventure", {})

    def __create_file(self, adventure):
        try:
            os.remove(self.tmpfilePath)
        except OSError:
            pass
        title = adventure["title"].replace("\\n", "\n")
        desc = adventure["desc"].replace("\\n", "\n")

        pdf = Adventure()
        pdf.set_margins(left=18, top=0, right=0)
        pdf.set_auto_page_break(False)

        pdf.add_page(orientation='P', format=(90,115))
        pdf.set_font('Arial', 'B', 16)
        pdf.multi_cell(0, 6, title, align='C')
        pdf.ln()
        pdf.set_font('Arial', '', 12)
        pdf.multi_cell(0, 6, desc, align='C')
        pdf.output(self.tmpfilePath, 'F')

    def __ready_to_print(self):
        self.ready_to_print = True

    def printAdventure(self, adventure):
        if self.ready_to_print:
            self.__create_file(adventure)
            self.__print()
            self.ready_to_print = False
            t = threading.Timer(1.0, self.__ready_to_print)
            t.start()