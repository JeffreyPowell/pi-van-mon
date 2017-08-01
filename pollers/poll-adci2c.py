#!/usr/bin/python

from ABElectronics_ADCPi import ADCPi
import time
import datetime
import os
import yaml

config = yaml.safe_load(open("/home/pi/bin/pi-van-mon/config.yaml"))

#print( config )

for device in config['devices']['adci2c']:
    #print( device )

    adda = int(config['devices']['adci2c'][device]['adda'])
    addb = int(config['devices']['adci2c'][device]['addb'])

    rate = int(config['devices']['adci2c'][device]['rate'])

    #print( adda, addb, rate )


    try:
        adc = ADCPi( adda, addb, rate)

        for pin in config['devices']['adci2c'][device]['pins']:

          #print( pin )

          t = datetime.datetime.now().strftime('%s')

          factor = float(config['devices']['adci2c'][device]['pins'][pin]['factor'])
          offset = float(config['devices']['adci2c'][device]['pins'][pin]['offset'])

          #print( factor, offset )

          rawdata = adc.readVoltage( pin )
          data = str( ( rawdata + offset ) * factor )

          #print( device, pin, rawdata, data )

          filename = '/home/pi/bin/pi-van-mon/data/adci2c-'+str(device)+'-'+str(pin)+'.rrd'


          if( not os.path.exists( filename ) ):
            #print ( os.path.exists( filename ))
            os.system('/usr/bin/rrdtool create '+filename+' --step 60 --start now DS:data:GAUGE:120:U:U RRA:AVERAGE:0.5:1:10080 RRA:AVERAGE:0.5:5:51840 RRA:AVERAGE:0.5:60:4380')

          os.system('/usr/bin/rrdtool update '+filename+" "+str(t)+':'+data)

    except: # Device probably not plugged in :(
        pass
