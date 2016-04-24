from GUI import View, Button


class MenuView(View):

    def draw(self, canvas, update_rect):
        self.add(Button("hi"))