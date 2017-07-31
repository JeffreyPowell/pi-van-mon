#!/bin/bash

#          Raspberry Pi setup, 'pi-van' configuration script.
# Author : Jeffrey.Powell ( jffrypwll <at> googlemail <dot> com )
# Date   : July 2017

# Die on any errors

#set -e
clear

if [[ `whoami` != "root" ]]
then
  printf "\n\n Script must be run as root. \n\n"
  exit 1
fi

OS_VERSION=$(cat /etc/os-release | grep VERSION=)
if [[ $OS_VERSION != *"jessie"* ]]
then
  printf "\n\n EXITING : Script must be run on PI OS Jessie. \n\n"
  exit 1
fi

APACHE_INSTALLED=$(which apache2)
if [[ "$APACHE_INSTALLED" == "" ]]
then
  printf "\n\n Installing Apache ...\n"
  # Install Apache
  apt-get install apache2 -y
  update-rc.d apache2 enable
  a2dissite 000-default.conf
  service apache2 restart

  APACHE_INSTALLED=$(which apache2)
    if [[ "$APACHE_INSTALLED" == "" ]]
    then
      printf "\n\n EXITING : Apache installation FAILED\n"
      exit 1
    fi
else
  printf "\n\n Apache is already installed. \n"
fi

PHP_INSTALLED=$(which php)
if [[ "$PHP_INSTALLED" == "" ]]
then
  printf "\n\n Installing PHP ...\n"
  # Install Apache
  apt-get install php5 -y

  PHP_INSTALLED=$(which php)
    if [[ "$PHP_INSTALLED" == "" ]]
    then
      printf "\n\n EXITING : PHP installation FAILED\n"
      exit 1
    fi
else
  printf "\n\n PHP is already installed. \n"
fi

MYSQL_INSTALLED=$(which mysql)
if [[ "$MYSQL_INSTALLED" == "" ]]
then
  printf "\n\n Installing MYSQL ...\n"
  # Install Apache
  apt-get install mysql-server -y --fix-missing

  MYSQL_INSTALLED=$(which mysql)
    if [[ "$MYSQL_INSTALLED" == "" ]]
    then
      printf "\n\n EXITING : MYSQL installation FAILED\n"
      exit 1
    fi
else
  printf "\n\n MYSQL is already installed. \n"
fi

# sudo apt-get install php5-mysql

PHPMYSQL_INSTALLED=$(find /var/lib/dpkg -name php5-mysql*)
if [[ "$PHPMYSQL_INSTALLED" == "" ]]
then
  printf "\n\n Installing MYSQL PHP Module ...\n"
  # Install Apache
  apt-get install php5-mysql -y

  PHPMYSQL_INSTALLED=$(find /var/lib/dpkg -name php5-mysql*)
    if [[ "$PHPMYSQL_INSTALLED" == "" ]]
    then
      printf "\n\n EXITING : MYSQL PHP Module installation FAILED\n"
      exit 1
    fi
else
  printf "\n\n MYSQL PHP Module is already installed. \n"
fi

# apt-get install python3-mysqldb -y

PYMYSQL_INSTALLED=$(find /var/lib/dpkg -name python-mysql*)
if [[ "$PYMYSQL_INSTALLED" == "" ]]
then
  printf "\n\n Installing MYSQL Python Module ...\n"
  # Install Apache
  apt-get install python-mysqldb -y

  PYMYSQL_INSTALLED=$(find /var/lib/dpkg -name python-mysql*)
    if [[ "$PYMYSQL_INSTALLED" == "" ]]
    then
      printf "\n\n EXITING : MYSQL Python Module installation FAILED\n"
      exit 1
    fi
else
  printf "\n\n MYSQL Python Module is already installed. \n"
fi


RRD_INSTALLED=$(find /var/lib/dpkg -name rrdtool*)
if [[ "$RRD_INSTALLED" == "" ]]
then
  printf "\n\n Installing RRD tool ...\n"
  # Install Apache
  apt-get install rrdtool php5-rrd -y

  RRD_INSTALLED=$(find /var/lib/dpkg -name rrdtool*)
    if [[ "$RRD_INSTALLED" == "" ]]
    then
      printf "\n\n EXITING : RRD tool installation FAILED\n"
      exit 1
    fi
else
  printf "\n\n RRD tool is already installed. \n"
fi

if [ ! -d "/home/pi/bin" ]
then
  mkdir "/home/pi/bin"
fi

if [ ! -d "/home/pi/bin/ABElectronics_Python_Libraries" ]
then
  printf "\n\n Installing ADC libraries ...\n"
  cd "/home/pi/bin"
  git clone "https://github.com/abelectronicsuk/ABElectronics_Python_Libraries.git"
else
  printf "\n\n ADC libraries are already installed. \n"
fi


if [ ! -f "/etc/cron.d/pi-van-mon-update" ]
then
  printf "\n\n Installing cron job ...\n"

  cat > /etc/cron.d/pi-van-mon-update <<CRON
*/5 8-23  * * *    /bin/bash /home/pi/bin/scripts/pi-van-mon-update.sh
CRON
  service cron restart
else
  printf "\n\n Cron job already installed. \n"
fi


if [ -d "/var/www/pi-heating-hub" ]
then
  printf "\n\n Copying code to /var/www/pi-van-mon ...\n"
  rm -rf "/var/www/pi-heating-hub"

  cp -r "/home/pi/bin/pi-van-mon/www" "/var/www/pi-van-mon"

  chown -R pi:www-data "/var/www/pi-van-mon"
  chmod -R 755 "/var/www/pi-van-mon"
  chmod -R 775 "/var/www/pi-van-mon"
else
  printf "\n\n /var/www/pi-van-mon already exists. \n"
fi


# configure app


# configure apache vh on port 8080

if [ -f "/etc/apache2/sites-available/pi-van-mon.conf" ]
then
  printf "\n\n Configuring VHost ...\n"

  cat > /etc/apache2/ports.conf <<PORTS
Listen 80
PORTS

  cat > /etc/apache2/sites-available/pi-van-mon.conf <<VHOST
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/pi-van-mon/
    <Directory /var/www/pi-van-mon/>
        Options -Indexes
        AllowOverride all
        Order allow,deny
        allow from all
    </Directory>

    ErrorLog /var/log/apache2/error.log
    CustomLog /var/log/apache2/access.log combined
</VirtualHost>
VHOST

  a2ensite pi-van-mon.conf
  service apache2 restart
else
  printf "\n\n VHost already exists. \n"
fi

printf "\n\n Installation Complete. Some changes might require a reboot. \n\n"
exit 1
