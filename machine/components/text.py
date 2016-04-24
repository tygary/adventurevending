from GUI import Canvas


class Text(Canvas):

    def __init__(self, text):
        Canvas.__init__(self)
        self.height = 1
        self.width = 1

        print(text)