#!/usr/bin/python

import time
import datetime
import os
import yaml

config = yaml.safe_load(open("/home/pi/bin/van/config.yaml"))

#print( config )

for device in config['devices']['w1']:
    #print( device )

    add = str(config['devices']['w1'][device]['add'])


    try:
        x=1
    except:
        pass
    
    # Open the file that we viewed earlier so that python can see what is in it. Replace the serial number as before.
    tfile = open("/sys/bus/w1/devices/"+add+"/w1_slave")
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

    t = datetime.datetime.now().strftime('%s')

    factor = float(config['devices']['w1'][device]['factor'])
    offset = float(config['devices']['w1'][device]['offset'])

    #print( factor, offset )
    data = str( ( temperature * factor ) + offset )

    filename = '/home/pi/bin/van/data/w1-'+str(device)+'-'+str(add)+'-0.rrd'
    #print filename
    
    if( not os.path.exists( filename ) ):
        #print ( os.path.exists( filename ))
        os.system('/usr/bin/rrdtool create '+filename+' --step 60 \
        --start now \
        DS:data:GAUGE:120:U:U \
        RRA:MIN:0.5:1:10080 \
        RRA:MIN:0.5:5:51840 \
        RRA:MIN:0.5:60:8760 \
        RRA:AVERAGE:0.5:1:10080 \
        RRA:AVERAGE:0.5:5:51840 \
        RRA:AVERAGE:0.5:60:8760 \
        RRA:MAX:0.5:1:10080 \
        RRA:MAX:0.5:5:51840 \
        RRA:MAX:0.5:60:8760')

    os.system('/usr/bin/rrdtool update '+filename+" "+str(t)+':'+data)

#except:
    #pass
