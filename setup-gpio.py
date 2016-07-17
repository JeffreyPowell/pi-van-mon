import RPi.GPIO as GPIO

GPIO.setmode(GPIO.BOARD)

chan_list = [31,33,35,37,32,36,38,40]

GPIO.setup(chan_list, GPIO.OUT)
