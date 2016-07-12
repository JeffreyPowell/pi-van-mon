#!/bin/bash

cd /home/pi/bin/van

git pull | mail -s "Van Git Pull1" jffrypwll@googlemail.com

$result={ git pull }

echo $result | mail -s "Van Git Pull2" jffrypwll@googlemail.com
