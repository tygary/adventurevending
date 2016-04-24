import pickle
from GUI import Document


class VendingDoc(Document):

    adventures = None
    gifts = None
    blobs = None

    def new_contents(self):
        self.blobs = []
        self.adventures = []
        self.gifts = []

    def read_contents(self, file):
        self.blobs = pickle.load(file)

    def write_contents(self, file):
        pickle.dump(self.blobs, file)

    def add_blob(self, blob):
        self.blobs.append(blob)
        self.changed()
        self.notify_views('blob_changed', blob)

    def find_blob(self, x, y):
        for blob in self.blobs:
            if blob.contains(x, y):
                return blob
        return None

    def move_blob(self, blob, dx, dy):
        self.notify_views('blob_changed', blob)
        blob.move(dx, dy)
        self.changed()
        self.notify_views('blob_changed', blob)

    def delete_blob(self, blob):
        self.notify_views('blob_changed', blob)
        self.blobs.remove(blob)
        self.changed()