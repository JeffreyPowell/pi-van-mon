#!/bin/bash

cd /home/pi/bin/van

git pull | mail -s "Van Git Pull1" jffrypwll@googlemail.com

result=$( git pull )

if [ $result = "Already up-to-date." ]; then
  echo $result | mail -s "Van Git Pull2" jffrypwll@googlemail.com
else
  echo $result | mail -s "Van Git Pull3" jffrypwll@googlemail.com
fi
