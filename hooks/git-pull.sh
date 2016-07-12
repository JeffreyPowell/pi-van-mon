#!/bin/bash

cd /home/pi/bin/van

result=$( git pull 2>&1 )

if [ "$result" != "Already up-to-date." ]; then
  result+=$( echo && echo && git log -p -n 1 2>&1 )
  echo "$result" | mail -s "Van Git Pull - UPDATED" jffrypwll@googlemail.com
#else
  #echo "$result" | mail -s "Van Git Pull - NO CHANGE" jffrypwll@googlemail.com
fi
