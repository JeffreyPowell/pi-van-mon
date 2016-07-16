import time
time.sleep(5)

try:
    import RPi.GPIO as GPIO
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")

GPIO.setmode(GPIO.BOARD)

GPIO.setwarnings(False)

chan_list = [31,33,35,37]

GPIO.setup(chan_list, GPIO.OUT, initial=GPIO.HIGH)

while True :

    GPIO.output(31, not GPIO.input(31))

    time.sleep(1)

    GPIO.output(33, not GPIO.input(33))

    time.sleep(1)

    GPIO.output(35, not GPIO.input(35))

    time.sleep(1)

    GPIO.output(37, not GPIO.input(37))

    time.sleep(1)
