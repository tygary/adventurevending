from GUI import View, Button, Grid, Row
from components.text import Text

class DashboardView(View):

    def draw(self, canvas, update_rect):
        adventure_button = Button("Adventures")
        gifts_button = Button("Gifts")

        row_items = [Button("hi"), Button("Edit"), Button("Remove")]

        row_items2 = [Button("hi2"), Button("Edit"), Button("Remove")]

        rows = [[Row(row_items)], [Row(row_items2)]]

        grid = Grid(rows)

        self.add(grid)

        rows.pop()

        #self.add(adventure_button)
        #self.add(gifts_button)
