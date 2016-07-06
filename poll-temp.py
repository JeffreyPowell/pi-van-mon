import time
import datetime
import os
import yaml

config = yaml.safe_load(open("/home/pi/bin/van/config.yaml"))

print( config )

for device in config['devices']['adci2c']:
    print( device )



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
