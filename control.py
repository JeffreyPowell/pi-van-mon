#!/usr/bin/sudo /usr/bin/python

import time
import RPi.GPIO as GPIO

def turn_on(pin):
    "Turns on GPIO pin"

    GPIO.setup(pin, GPIO.OUT)

    GPIO.output(pin, GPIO.HIGH)

    return

def turn_off(pin):

    GPIO.output(pin, GPIO.LOW)

    GPIO.setup(pin, GPIO.OUT)

    return
    
#GPIO.setwarnings(False)

print GPIO.RPI_REVISION

GPIO.setmode(GPIO.BOARD)
#GPIO.setmode(GPIO.BCM)

chan_list = [31,33,35,37,32,36,38,40]
#chan_list = [6]

time.sleep(1)

for pin in chan_list:
    print pin

    n = 10

    while n>0 :
        n = n - 1

        print pin, n

        turn_on(pin)

        time.sleep(0.1)

        turn_off(pin)

        time.sleep(0.1)

GPIO.cleanup()
