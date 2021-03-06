#!/bin/bash


datafile="adci2c-2-4"
start="-1d"
dataname="Kitchen temp"
dataunit="(C)"
datacf="AVERAGE"
width=500
height=300
linecol="00FF00"
areacol="00FF0020"

linewidth=1.5
vertaxislabelpt=6
allaxisvaluept=6
legendpt=6

/usr/bin/rrdtool graph /home/pi/bin/pi-van-mon/www/images/e-$datafile$start.png \
--start $start \
--vertical-label "$dataunit" \
--height=$height \
--width=$width \
-cBACK#EEEEEE00 \
-cSHADEA#EEEEEE00 \
-cSHADEB#EEEEEE00 \
-cFONT#000000 \
-cCANVAS#FFFFFF00 \
-cGRID#a5a5a5 \
-cMGRID#FF9999 \
-cFRAME#5e5e5e \
-cARROW#5e5e5e \
-nTITLE:9 \
-nLEGEND:$legendpt \
-nAXIS:$allaxisvaluept \
-nUNIT:$vertaxislabelpt \
DEF:a=/home/pi/bin/pi-van-mon/data/$datafile.rrd:data:$datacf \
CDEF:b=a,1,* \
AREA:b#$areacol \
LINE$linewidth:b#$linecol:"$dataname" \
GPRINT:b:MIN:"min %6.2lf" \
GPRINT:b:MAX:"max %6.2lf\\n"


# $ret = rrd_graph($output, $options);
#  if (! $ret) {
#    echo "<b>Graph error: </b>".rrd_error()."\n";
#  }
#}



#mail -a /home/pi/bin/therm/www/images/e-$datafile$start.png -s "$dataname" jffrypwll@googlemail.com < /dev/null




#from="jffrypwll@pi-kitchen"
to="jffrypwll@googlemail.com"
subject="rpi cons temp"
body="Contents of backups/*.tar.*"
declare -a attachments
attachments=($( ls /home/pi/bin/pi-van-mon/www/images/e-*.png ))
#attachments={${ find /backups -maxdepth 1 -newermt $(date +%Y-%m-%d -d '1 day ago' ) -type f -print } }

declare -a attargs
for att in "${attachments[@]}"; do
  attargs+=( "-a"  "$att" )
done

mpack -s "$subject" "${attargs[@]}" "$to" <<< "$body"
