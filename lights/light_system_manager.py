import os
import constants
from light_system import LightSystem
from multiprocessing.queues import SimpleQueue
from time import sleep

class LightSystemManager():
    @classmethod
    def setup(cls):
        cls.queue = SimpleQueue()
        cls.ls = LightSystem(cls.queue)
        cls.ls.start()
        # Sleep for things to pick up
        sleep(.5)
    @classmethod
    def cleanup(cls):
        cls.ls.terminate()
    @classmethod
    def open_box(cls, box):
        cls.queue.put(box)
        os.kill(cls.ls.pid, constants.OPEN_BOX)
    @classmethod
    def select_box(cls, box):
        cls.queue.put(box)
        os.kill(cls.ls.pid, constants.SELECT_BOX)

