import RPi.GPIO as GPIO

def add_event_detection(pin, callback, bothdirections=False):
    try:
        GPIO.setup(pin, GPIO.IN)
        GPIO.remove_event_detect(pin)
        GPIO.add_event_detect(pin, GPIO.FALLING, callback=callback)
        if bothdirections:
            GPIO.add_event_detect(pin, GPIO.RISING, callback=callback)
    except RuntimeError:
        try:
            GPIO.remove_event_detect(pin)
            GPIO.add_event_detect(pin, GPIO.FALLING, callback=callback)
            if bothdirections:
                GPIO.add_event_detect(pin, GPIO.RISING, callback=callback)
        except RuntimeError:
            pass