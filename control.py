import time

import RPi.GPIO as GPIO

GPIO.setmode(GPIO.BOARD)

#GPIO.setwarnings(False)

chan_list = [31,33,35,37]

GPIO.setup(chan_list, GPIO.OUT, initial=GPIO.LOW)

chan_list = [32,36,38,40]

GPIO.setup(chan_list, GPIO.OUT, initial=GPIO.LOW)

while True :


    GPIO.output(31, 1)

    time.sleep(0.1)

    GPIO.output(31, 0)

    time.sleep(0.1)

    GPIO.output(31, 1)

    time.sleep(0.1)

    GPIO.output(31, 0)

    time.sleep(0.1)

    GPIO.output(31, not GPIO.input(31))

    time.sleep(0.1)

    GPIO.output(33, not GPIO.input(33))

    time.sleep(0.1)

    GPIO.output(35, not GPIO.input(35))

    time.sleep(0.1)

    GPIO.output(37, not GPIO.input(37))

    time.sleep(0.1)

    GPIO.output(32, not GPIO.input(32))

    time.sleep(0.1)

    GPIO.output(36, not GPIO.input(36))

    time.sleep(0.1)

    GPIO.output(38, not GPIO.input(38))

    time.sleep(0.1)

    GPIO.output(40, not GPIO.input(40))

    time.sleep(0.1)
