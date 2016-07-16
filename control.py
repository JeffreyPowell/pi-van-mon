import time
time.sleep(5)

try:
    import RPi.GPIO as GPIO
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")

GPIO.setmode(GPIO.BCM)

GPIO.setwarnings(False)

chan_list = [6,13,19,26]

GPIO.setup(chan_list, GPIO.OUT, initial=GPIO.HIGH)

while True :

    GPIO.output(06, not GPIO.input(06))

    time.sleep(1)

    GPIO.output(13, not GPIO.input(13))

    time.sleep(1)

    GPIO.output(19, not GPIO.input(19))

    time.sleep(1)

    GPIO.output(26, not GPIO.input(26))

    time.sleep(1)
