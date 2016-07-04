<?php

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

print_r( $config );

foreach( $config['display']['device'] as $device )
{
  print_r( $device );
  print_r( "===\n" );
  print_r( $config['display']['device'][device]['type'] );
  print_r( "---\n" );
}





echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body bgcolor='#808080'>";

echo "DEVICES";

echo "</body></html>";
exit;

?>
