#!/bin/bash

echo "40" > /sys/class/gpio/export
echo "out" > /sys/class/gpio/gpio40/direction

echo 0 > /sys/class/gpio/gpio40/value
sleep 1
echo 1 > /sys/class/gpio/gpio40/value
sleep 1
echo 0 > /sys/class/gpio/gpio40/value
sleep 1
echo 1 > /sys/class/gpio/gpio40/value
sleep 1
echo 0 > /sys/class/gpio/gpio40/value
sleep 1
echo 1 > /sys/class/gpio/gpio40/value
sleep 1
echo 0 > /sys/class/gpio/gpio40/value
sleep 1
echo 1 > /sys/class/gpio/gpio40/value
sleep 1
echo 0 > /sys/class/gpio/gpio40/value
sleep 1
echo 1 > /sys/class/gpio/gpio40/value
sleep 1
echo "40" > /sys/class/gpio/unexport
