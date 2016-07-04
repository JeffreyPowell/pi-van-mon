<?php

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

print_r( $config );
print_r( "\n\n" );

$device_count = count($config['devices']['type']);

for ($device_index=1; $device_index <= $device_count; $device_index++) {
  #print_r( $device );
  print_r( "===\n" );

  $device_type    = (string) $config['devices']['type'][$device_index];
  $device_id      = (string) $config['devices']['id'][$device_index];
  $device_pin_num = (string) $config['devices']['pin'][$device_index];

  print_r( $device_index );
  print_r( $device_type );
  print_r( $device_id );
  print_r( $device_pin_num );
  print_r( "---\n" );

  $img_name = $device_type.'-'.$device_id.'-'.$device_pin_num;

  $img_filename = '/home/pi/bin/van/www/images/'.$img_name.'.png';
  $rrd_filename = '/home/pi/bin/van/data/'.$img_name.'.rrd';

  print_r( $rrd_filename );
  print_r( $img_filename );
  print_r( "***\n" );

  # create the rrd image

  create_graph( $rrd_filename, $img_filename,  "-12h",         "SIP CALLS last 12 hours",             "200", "1100");

}





echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body bgcolor='#808080'>";

echo "DEVICES";

echo "</body></html>";
exit;

function create_graph($input, $output, $start, $title, $height, $width) {

  $options = array(
    "--slope-mode",
    "--start", $start,
    "--title=$title",
    "--vertical-label=Active Calls",
    "--lower=0",
    "--height=$height",
    "--width=$width",
    "-cBACK#161616",
    "-cCANVAS#1e1e1e",
    "-cSHADEA#000000",
    "-cSHADEB#000000",
    "-cFONT#c7c7c7",
    "-cGRID#888800",
    "-cMGRID#ffffff",
    "-nTITLE:10",
    "-nAXIS:12",
    "-nUNIT:10",
    "-y 1:5",
    "-cFRAME#ffffff",
    "-cARROW#000000",
    "DEF:datamax=$input:data:MAX",
    "CDEF:transdatamax=datamax,1,*",
    "AREA:transdatamax#b6d14b40",
    "LINE4:transdatamax#a0b842:Active SIP Calls",
    "COMMENT:\\n",
    "GPRINT:transdatamax:MAX:Calls Max %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
