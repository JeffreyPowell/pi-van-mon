#!/bin/bash

cd /home/pi/bin/pi-van-mon

git reset --hard HEAD

result=$( git pull 2>&1 )

if [ "$result" = "Already up-to-date." ]; then
  echo $result
  #echo "$result" | mail -s "Van Git Pull - NO CHANGE" jffrypwll@googlemail.com
  sleep 1
elif [[ $result == *"Couldn't resolve host"* ]]; then
  echo $result
  sleep 1
else
  result+=$( echo && echo && git log -p -n 1 2>&1 )
  echo $result
  #echo "$result" | mail -s "Van Git Pull - UPDATED" jffrypwll@googlemail.com

  cp -r "/home/pi/bin/pi-van-mon/www" "/var/www/pi-van-mon"
fi
