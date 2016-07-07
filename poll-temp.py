import time
import datetime
import os
import yaml

config = yaml.safe_load(open("/home/pi/bin/van/config.yaml"))

print( config )

for device in config['devices']['w1']:
    print( device )

    # Open the file that we viewed earlier so that python can see what is in it. Replace the serial number as before. 
    tfile = open("/sys/bus/w1/devices/10-000802824e58/w1_slave") 
    # Read all of the text in the file. 
    text = tfile.read() 
    # Close the file now that the text has been read. 
    tfile.close() 
    # Split the text with new lines (\n) and select the second line. 
    secondline = text.split("\n")[1] 
    # Split the line into words, referring to the spaces, and select the 10th word (counting from 0). 
    temperaturedata = secondline.split(" ")[9] 
    # The first two characters are "t=", so get rid of those and convert the temperature from a string to a number. 
    temperature = float(temperaturedata[2:]) 
    # Put the decimal point in the right place and display it. 
    temperature = temperature / 1000 
    print temperature

***************************************************************************
#!/bin/bash
#
#

DEVICEID="$1"

RRDFILE="/home/pi/bin/therm/data/sensor-$DEVICEID-temp.rrd"
TEXTFILE="/home/pi/bin/therm/data/sensor-$DEVICEID-temp.txt"

DEVICEFILE="/sys/bus/w1/devices/$DEVICEID/w1_slave"

# create database if not exists
[ -f $RRDFILE ] || {
/usr/bin/rrdtool create $RRDFILE \
--step 60 \
--start now \
DS:data:GAUGE:120:U:U \
RRA:MIN:0.5:1:1400 \
RRA:MIN:0.5:5:8640 \
RRA:MIN:0.5:60:8760 \
RRA:AVERAGE:0.5:1:1400 \
RRA:AVERAGE:0.5:5:8640 \
RRA:AVERAGE:0.5:60:8760 \
RRA:MAX:0.5:1:1400 \
RRA:MAX:0.5:5:8640 \
RRA:MAX:0.5:60:8760
}

echo "--.-" > $TEXTFILE

while [ "$DEVICESTATUS" != "YE" ]
do

    sleep 0.2

    DEVICEDATA=$( cat $DEVICEFILE )

#    echo $DEVICEDATA

    DEVICESTATUS=$( echo $DEVICEDATA | sed "s/.*: crc=.* \([A-Z].\).*t=.*/\1/" )

#    echo $DEVICESTATUS

done

DEVICEDATA=$( echo $DEVICEDATA | sed "s/.*t=\(.[0-9.]*\).*/\1/" )

#echo $DEVICEDATA

DATA=$(echo "$DEVICEDATA/1000.0" | bc -l )

#echo $DATA

/usr/bin/rrdtool update $RRDFILE `date +"%s"`:$DATA

echo $DATA > $TEXTFILE
