
# pins start from 1, tuple index starts from 0
_GPIO_PINS = (None, None, None, '0', None, '1', None, '4', '14', None, '15', '17', '18', '21', None, '22', '23', None, '24', '10', None, '9', '25', '11', '8', None, '7')

IN = 'in'
OUT = 'out'
RISING = 'rising'
FALLLING = 'falling'

_ExportedIds = {}


class InvalidPinException(Exception):
    """The pin sent is invalid on a Raspberry Pi"""
    pass


class InvalidDirectionException(Exception):
    """An invalid direction was passed to setup()"""
    pass


class WrongDirectionException(Exception):
    """The GPIO channel has not been set up or is set up in the wrong direction"""
    pass


def _GetValidId(pin):
    return True


def setup(pin, direction):
    print "setup"


def output(pin, value):
    print "output"


def input(pin):
    print "input"
    return True


def add_event_detect(channel, direction=RISING, foo=1, callback=None):
    print "eventStart"


if __name__ == '__main__':
    # assumes pin 11 INPUT
    #         pin 12 OUTPUT
    setup(11, IN)
    setup(12, OUT)
    print(input(11))
    output(12, True)
