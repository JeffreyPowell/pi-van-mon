#!/bin/bash

cd /home/pi/bin/van

#git pull | mail -s "Van Git Pull1" jffrypwll@googlemail.com

result=$( git pull 2>&1 )

if [ "$result" = "Already up-to-date." ]; then
  echo "$result" | mail -s "Van Git Pull - no change" jffrypwll@googlemail.com
else
  echo "$result" | mail -s "Van Git Pull - something changed" jffrypwll@googlemail.com
fi
###
