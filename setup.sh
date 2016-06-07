#!/bin/bash

# only run as root
if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

if [ -L /var/www/van ]
then
  rm /var/www/van
fi

ln -s /home/pi/bin/van/www /var/www/van
