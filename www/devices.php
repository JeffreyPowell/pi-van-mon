<?php

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

print_r( $config );

$device_count = count($config['devices']['type']);

for ($device_index=0; $device_index < $device_count; $device_index++) {
  print_r( $device );
  print_r( "===\n" );

  $device_type    = $config['devices']['type'][$device_index];
  $device_id      = $config['devices']['device'][$device_index];
  $device_pin_num = $config['devices']['pin'][$device_index];

  print_r( $device_type );
  print_r( $device_id );
  print_r( $device_pin_num );
  print_r( "---\n" );

  $rrd_filename = '/home/pi/bin/van/data/'+$device_type+'-'+$device_id+'-'+$device_pin_num+'.rrd';

  print_r( $rrd_filename );

  
}





echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body bgcolor='#808080'>";

echo "DEVICES";

echo "</body></html>";
exit;

?>
