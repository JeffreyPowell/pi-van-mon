#!/usr/bin/python

from ABElectronics_ADCPi import ADCPi
import time
import datetime
import os
import yaml

config = yaml.safe_load(open("config.yaml"))

print( config )
print( config['devices']['adc1i2c']['adda'] )

for device in config['devices']['adci2c']:
    print( device )

    adda = int(config['devices'][device]['adda'])
    addb = int(config['devices'][device]['addb'])

    rate = int(config['devices'][device]['rate'])

    print( adda, addb, rate )

    x1

    adc = ADCPi( adda, addb, rate)


# Sample rate can be 12,14, 16 or 18
adc1 = ADCPi(int(config['devices']['adc1i2c']['adda']), int(config['devices']['adc1i2c']['addb']), 12)


x1 = 769.0 / 12.91
x2 = 773.0 / 12.91
x3 = 768.0 / 12.91
x4 = 767.0 / 12.86
x5 = 1
x6 = 1
x7 = 1
x8 = 1

#x1=x2=x3=1

y = 1.00
z = 1.00

rate = 0.01 # seconds
samples = 1 # samples

#print ("debug 2")

for i in range(0, 1):

        t = datetime.datetime.now().strftime('%s')

        v1 = 0
        v2 = 0
        v3 = 0
        v4 = 0
        v5 = 0
        v6 = 0
        v7 = 0
        v8 = 0

        for j in range(0, samples):

                v1 = v1 + adc1.readRaw(1)
                v2 = v2 + adc1.readRaw(2)
                v3 = v3 + adc1.readRaw(3)
                v4 = v4 + adc1.readRaw(4)
                v5 = v5 + adc1.readRaw(5)
                v6 = v6 + adc1.readRaw(6)
                v7 = v7 + adc1.readRaw(7)
                v8 = v8 + adc1.readRaw(8)
                #v5 = v5 + int("%8.0f" % (adc.readRaw(5)/3))
                #v6 = v6 + int("%8.0f" % (adc.readRaw(6)/3))
                #v7 = v7 + int("%8.0f" % (adc.readRaw(7)/3))
                #v8 = v8 + int("%8.0f" % (adc.readRaw(8)/3))
                time.sleep(rate)

        v1 = v1 / samples
        v2 = v2 / samples
        v3 = v3 / samples
        v4 = v4 / samples
        v5 = v5 / samples
        v6 = v6 / samples
        v7 = v7 / samples
        v8 = v8 / samples

        s1 = "%2.3f" % (   v1    /x1 )
        s2 = "%2.3f" % (   v2    /x2 )
        s3 = "%2.3f" % (   v3    /x3 )
        s4 = "%2.3f" % (   v4    /x4 )
        s5 = "%2.3f" % (   v5    /x5 )
        s6 = "%2.3f" % (   v6    /x6 )
        s7 = "%2.3f" % (   v7    /x7 )
        s8 = "%2.3f" % (   v8    /x8 )
        #s5 = "%4.4f" % ( ( v5-z )/y )
        #s6 = "%4.4f" % ( ( v6-z )/y )
        #s7 = "%4.4f" % ( ( v7-z )/y )
        #s8 = "%4.4f" % ( ( v8-z )/y )

        #os.system('/usr/bin/rrdtool update /usr/local/scripts/git/pi-adc-mon/data/adc-volts.rrd `date +"%s"`:$V1:$V2:$V3:$V4:$V5:$V6:$V7:$V8')

        print( s1, s2, s3, s4, s5, s6, s7, s8 )

        #os.system('/usr/bin/rrdtool update /usr/local/scripts/git/pi-adc-mon/data/adc-volts.rrd '+str(t)+':'+str(s1))