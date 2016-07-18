#!/usr/bin/sudo /usr/bin/python

import time
import RPi.GPIO as GPIO

#GPIO.setwarnings(False)

print GPIO.RPI_REVISION

GPIO.setmode(GPIO.BOARD)
#GPIO.setmode(GPIO.BCM)

chan_list = [31,33,35,37,32,36,38,40]
#chan_list = [6]

time.sleep(1)

for pin in chan_list:
    print pin

    GPIO.setup(pin, GPIO.OUT)

    n = 10

    while n>0 :
        n = n - 1

        print pin, n

        GPIO.output(pin, GPIO.HIGH)

        time.sleep(0.1)

        GPIO.output(pin, GPIO.LOW)

        time.sleep(0.1)

GPIO.cleanup()
