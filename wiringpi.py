#!/usr/bin/sudo /usr/bin/python

import time

import wiringpi



wiringpi.wiringPiSetup()

chan_list = [31,33,35,37,32,36,38,40]
#chan_list = [6]

time.sleep(1)

for pin in chan_list:
    print pin

    wiringpi.pinMode(pin, 1)

    n = 10

    while n>0 :
        n = n - 1

        print pin, n

        wiringpi.digitalWrite(pin, 0)

        time.sleep(0.1)

        wiringpi.digitalWrite(pin, 1)

        time.sleep(0.1)


for pin in chan_list:
    print pin

    wiringpi.digitalWrite(pin, 0)

    wiringpi.pinMode(pin, 0)
