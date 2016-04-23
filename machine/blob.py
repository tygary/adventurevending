from GUI.Geometry import pt_in_rect, offset_rect, rects_intersect


class Blob:

    def __init__(self, x, y):
        self.rect = (x - 20, y - 20, x + 20, y + 20)

    def contains(self, x, y):
        return pt_in_rect((x, y), self.rect)

    def intersects(self, rect):
        return rects_intersect(rect, self.rect)

    def move(self, dx, dy):
        self.rect = offset_rect(self.rect, (dx, dy))

    def draw(self, canvas):
        canvas.fill_frame_rect(self.rect)