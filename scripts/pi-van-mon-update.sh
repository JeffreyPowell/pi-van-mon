#!/bin/bash

cd /home/pi/code/pi-van-mon

result=$( git pull 2>&1 )

if [ "$result" = "Already up-to-date." ]; then
  #echo "$result" | mail -s "Van Git Pull - NO CHANGE" jffrypwll@googlemail.com
  sleep 1
elif [[ $result == *"Couldn't resolve host"* ]]
  sleep 1
else
  result+=$( echo && echo && git log -p -n 1 2>&1 )
  #echo "$result" | mail -s "Van Git Pull - UPDATED" jffrypwll@googlemail.com

  cp -r "/home/pi/code/pi-van-mon/www" "/var/www/pi-van-mon"
fi
