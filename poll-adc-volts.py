#!/usr/bin/python

from ABElectronics_ADCPi import ADCPi
import time
import datetime
import os
import yaml

config = yaml.safe_load(open("config.yaml"))

print( config )

for device in config['devices']['adci2c']:
    print( device )

    adda = int(config['devices']['adci2c'][device]['adda'])
    addb = int(config['devices']['adci2c'][device]['addb'])

    rate = int(config['devices']['adci2c'][device]['rate'])

    print( adda, addb, rate )

    

    adc = ADCPi( adda, addb, rate)

    for pin in config['devices']['adci2c'][device]['pins']:

      print( pin )

      t = datetime.datetime.now().strftime('%s')

      factor = float(config['devices']['adci2c'][device]['pins'][pin]['factor'])
      offset = float(config['devices']['adci2c'][device]['pins'][pin]['offset'])

      print( factor, offset )

      rawdata = adc.readRaw( pin )
      data = str( ( rawdata * factor ) - offset )

      print( rawdata, data )

      filename = '/home/pi/bin/van/data/adci2c-'+str(device)+'-'+str(pin)+'.rrd'      


      if( not os.path.exists( filename ) ):
        print ( os.path.exists( filename ))
        os.system('/usr/bin/rrdtool create '+filename+' --step 60 --start now DS:data:GAUGE:120:U:U RRA:AVERAGE:0.5:1:1400 RRA:AVERAGE:0.5:5:8640 RRA:AVERAGE:0.5:60:8760')

      os.system('/usr/bin/rrdtool update '+filename+" "+str(t)+':'+data)

      #os.system('/usr/bin/rrdtool update /usr/local/scripts/git/pi-adc-mon/data/adc-volts.rrd `date +"%s"`:$V1:$V2:$V3:$V4:$V5:$V6:$V7:$V8')

      #os.system('/usr/bin/rrdtool update /usr/local/scripts/git/pi-adc-mon/data/adc-volts.rrd '+str(t)+':'+str(s1))
