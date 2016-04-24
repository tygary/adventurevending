#
#  BlobEdit - A totally silly application for showing
#  ========   off the GUI framework and providing an example
#             of its use.
#
#  Blobs are red squares that you place on a Blob Document
#  by clicking and move around by dragging. You can save
#  your blob arrangement in a file and load it back later
#  to impress your friends (or send them away screaming).
#
#  News flash: Got a blob you don't want? Now you can
#  get rid of it by shift-clicking it! Isn't that useful!
#

from GUI import Application, Window, Cursor
from GUI.Files import FileType
from views.menuview import MenuView
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
        view = MenuView(model = document)
        win.place(view, left = 0, top = 0, right = 0, bottom = 0, sticky = 'nsew')
        win.show()





VendingApp().run()