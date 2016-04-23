from GUI import ScrollableView
from GUI.StdColors import black, red
from blob import Blob


class VendingView(ScrollableView):

    def draw(self, canvas, update_rect):
        canvas.erase_rect(update_rect)
        canvas.fillcolor = red
        canvas.pencolor = black
        for blob in self.model.blobs:
            if blob.intersects(update_rect):
                blob.draw(canvas)

    def mouse_down(self, event):
        x, y = event.position
        blob = self.model.find_blob(x, y)
        if blob:
            if not event.shift:
                self.drag_blob(blob, x, y)
            else:
                self.model.delete_blob(blob)
        else:
            self.model.add_blob(Blob(x, y))

    def drag_blob(self, blob, x0, y0):
        for event in self.track_mouse():
            x, y = event.position
            self.model.move_blob(blob, x - x0, y - y0)
            x0 = x
            y0 = y

    def blob_changed(self, model, blob):
        self.invalidate_rect(blob.rect)