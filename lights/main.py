# Main.py
from time import sleep
from light_system_manager import LightSystemManager

class Main():
    def __init__(self):
        self.light_system = LightSystemManager()

    def test(self):
        self.init_machine()
        print "started"
        #self.light_system.open_box(1)
        sleep(4)
        self.light_system.select_box(2)
        sleep(999)
        print "ending.."
        self.cleanup()
        print "end"

    def init_machine(self):
        self.light_system.setup()

    def cleanup(self):
        # Sleep to finish any trigger quickly
        sleep(0.5)
        self.light_system.cleanup()

if __name__ == "__main__":
    Main().test()
