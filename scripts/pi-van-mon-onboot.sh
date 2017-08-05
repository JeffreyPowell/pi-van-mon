#!/bin/bash

#          Raspberry Pi setup, 'pi-van' configuration script.
# Author : Jeffrey.Powell ( jffrypwll <at> googlemail <dot> com )
# Date   : July 2017

# Die on any errors

#set -e
#!/bin/bash

sleep 60

#/bin/systemctl restart sendmail.service
/sbin/service sendmail restart

IP=`hostname -i`
HOSTNAME=`hostname -f`
echo "$HOSTNAME online.  IP address: $IP" > /home/pi/bin/pi-van-mon/scripts/email.txt
echo >> /home/pi/bin/pi-van-mon/scripts/email.txt
date >> /home/pi/bin/pi-van-mon/scripts/email.txt

mail -s "$HOSTNAME online" -r restart@server.domain.tld jffrypwll@googlemail.com < /home/pi/bin/pi-van-mon/scripts/email.txt

rm -rf /home/pi/bin/pi-van-mon/scripts/email.txt

#/bin/systemctl restart sendmail.service
/sbin/service sendmail restart
