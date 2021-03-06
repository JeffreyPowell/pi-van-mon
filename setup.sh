#!/bin/bash

# only run as root
if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

if [ -L /var/www/van ]
then
  rm /var/www/van
fi

ln -s /home/pi/bin/van/www /var/www/van

apt-get install rrdtool


/usr/bin/rrdtool create /home/pi/bin/van/data/adc-volts.rrd \
--step 60 \
--start now \
DS:data:GAUGE:120:0:U \
RRA:AVERAGE:0.5:1:1400 \
RRA:AVERAGE:0.5:5:8640 \
RRA:AVERAGE:0.5:60:8760

export PYTHONPATH=${PYTHONPATH}:~/Desktop/ABElectronics_Python_Libraries/ADCDACPi/

apt-get install python-smbus

adduser pi i2c

apt-get install python-yaml

sudo apt-get install python-dev python-pip
sudo pip install wiringpi2
