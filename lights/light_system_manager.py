import os
import constants
from light_system import LightSystem
from multiprocessing.queues import SimpleQueue
from time import sleep

class LightSystemManager():
    def setup(self):
        self.queue = SimpleQueue()
        self.ls = LightSystem(self.queue)
        self.ls.start()
        # Sleep for things to pick up
        sleep(.5)

    def cleanup(self):
        self.ls.terminate()

    def open_box(self, box):
        self.queue.put(box)
        os.kill(self.ls.pid, constants.OPEN_BOX)

    def select_box(self, box):
        self.queue.put(box)
        os.kill(self.ls.pid, constants.SELECT_BOX)

