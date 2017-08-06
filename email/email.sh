#!/bin/bash

declare -a attachments
declare -a attargs

datafile=$1
#start=$2

#echo $datafile
#echo $start

dataname=$1
dataunit=""
datacf="AVERAGE"
width=500
height=300
linecol="00FF00"
areacol="00FF0020"

linewidth=1.5
vertaxislabelpt=6
allaxisvaluept=6
legendpt=6

list = ( "-1d" "-1w" "-1m" )

for t in "${list[@]}"; do
/usr/bin/rrdtool graph /home/pi/bin/pi-van-mon/www/images/e-$datafile$t.png \
--start $start \
--alt-y-grid \
--alt-autoscale \
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

attachments+=( "-A" "/home/pi/bin/pi-van-mon/www/images/e-$datafile$t.png" )

done

#mail -a /home/pi/bin/therm/www/images/e-$datafile$start.png -s "$dataname" jffrypwll@googlemail.com < /dev/null




#from="jffrypwll@pi-kitchen"
to="jffrypwll@googlemail.com"
subject="pi-van-mon $datafile"
body="pi-van-mon charts"
#attachment="/home/pi/bin/pi-van-mon/www/images/e-$datafile$start.png"


#attachments=($( ls /home/pi/bin/pi-van-mon/www/images/e-*.png ))


#attachments={${ find /backups -maxdepth 1 -newermt $(date +%Y-%m-%d -d '1 day ago' ) -type f -print } }

#declare -a attargs
#for att in "${attachments[@]}"; do
#  attargs+=( "-A"  "$att" )
#done


echo "$subject" "$attachment" "$to" "$body"

#mpack -s "$subject" "${attargs[@]}" "$to" <<< "$body"

mail -s "$subject" -A "${attargs[@]}" "$to" <<< "$body"
