from GUI import Application, Window
from GUI.Files import FileType
from views.dashboard import DashboardView
from documents.vendingdoc import VendingDoc


class VendingApp(Application):

    def __init__(self):
        Application.__init__(self)
        self.vending_type = FileType(name = "Adventure Vending Document", suffix = "vending",
                                  #mac_creator = "BLBE", mac_type = "BLOB", # These are optional
                                  )
        self.file_type = self.vending_type

    def open_app(self):
        self.new_cmd()

    def make_document(self, fileref):
        return VendingDoc(file_type = self.vending_type)

    def make_window(self, document):
        win = Window(size = (400, 400), document = document)
        # menu = Menu("title", "-")
        # win.menus = [menu]
        view = DashboardView(model = document, printable = False)
        win.place(view, left = 0, top = 0, right = 0, bottom = 0, sticky = 'nsew')
        win.show()


VendingApp().run()
