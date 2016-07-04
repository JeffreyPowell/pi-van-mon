<?php

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

print_r( $config );

$numdevices = count($config['devices']['type']);

for ($count=0; $count < $numdevices; $count++) {
  print_r( $count );
  print_r( "===\n" );
  print_r( $config['devices']['type'][$count] );
  print_r( $config['devices']['device'][$count] );
  print_r( $config['devices']['pin'][$count] );
  print_r( "---\n" );
}





echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body bgcolor='#808080'>";

echo "DEVICES";

echo "</body></html>";
exit;

?>
