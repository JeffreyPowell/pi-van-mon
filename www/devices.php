<?php

$period_span = $_GET['p'];
$chart_width = $_GET['w'];

#$PERIOD ='-1y';
if( $period_span == "" ) { $period_span = '-1d'; $chart_width = header("Location: devices.php?p=$period_span&w=$chart_width"); exit; }
if( $chart_width == "" ) { $chart_width = '500'; $chart_width = header("Location: devices.php?p=$period_span&w=$chart_width"); exit; }

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

#print_r( $config );
#print_r( "\n\n" );

$device_count = count($config['devices']['type']);

echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body bgcolor='#080808'>";

echo "<input type='button' onclick=\"location.href='devices.php?p=-1h&w=$chart_width';\" value='One Hour' />";
echo "<input type='button' onclick=\"location.href='devices.php?p=-8h&w=$chart_width';\" value='Eight Hours' />";
echo "<input type='button' onclick=\"location.href='devices.php?p=-1d&w=$chart_width';\" value='One Day' />";
echo "<input type='button' onclick=\"location.href='devices.php?p=-1w&w=$chart_width';\" value='One Week' />";
echo "<input type='button' onclick=\"location.href='devices.php?p=-1m&w=$chart_width';\" value='One Month' />";
echo "<input type='button' onclick=\"location.href='devices.php?p=-1y&w=$chart_width';\" value='One Year' />";
echo "<br>";
$chart_bigger = strval( intval($chart_width) + 100);
$chart_smaller = strval( intval($chart_width) - 100);
echo "<input type='button' onclick=\"location.href='devices.php?p=$period_span&w=$chart_bigger';\" value='Width +' />";
echo "<input type='button' onclick=\"location.href='devices.php?p=$period_span&w=$chart_smaller';\" value='Width -' />";
echo "<br>";

for ($device_index=1; $device_index <= $device_count; $device_index++) {
  #print_r( $device );
  #print_r( "===\n" );

  $device_type    = (string) $config['devices']['type'][$device_index];
  $device_id      = (string) $config['devices']['id'][$device_index];
  $device_pin_num = (string) $config['devices']['pin'][$device_index];

  $device_name = (string) $config['devices']['name'][$device_index];
  $device_units = (string) $config['devices']['units'][$device_index];

  #$span           = '-12h';

  #print_r( $device_index );
  #print_r( $device_type );
  #print_r( $device_id );
  #print_r( $device_pin_num );
  #print_r( "---\n" );

  $img_name = $device_type.'-'.$device_id.'-'.$device_pin_num;

  $img_filename = '/home/pi/bin/van/www/images/'.$img_name.$period_span.'.png';
  $rrd_filename = '/home/pi/bin/van/data/'.$img_name.'.rrd';

  #print_r( $rrd_filename );
  #print_r( $img_filename );
  #print_r( "***\n" );

  # create the rrd image

  create_graph( $rrd_filename, $img_filename,  $period_span, $device_name.' '.$period_span, $device_units, "200", $chart_width);

  # display the image

  echo "<img src='images/".$img_name.$period_span.".png' alt='Generated RRD image'><br><br>";

}


echo "</body></html>";
exit;

function create_graph($input, $output, $start, $title, $units, $height, $width) {

  $options = array(
    "--slope-mode",
    "--start", $start,
    "--title=$title",
    "--vertical-label=$units",
#    "--lower=0",
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
    "-nAXIS:9",
    "-nUNIT:10",
    "-y 0.2:5",
    "-cFRAME#ffffff",
    "-cARROW#000000",
    "DEF:dataavg=$input:data:AVERAGE",
    "CDEF:transdataavg=dataavg,1,*",
    "AREA:transdataavg#b6d14b40",
    "LINE4:transdataavg#a0b842:$title $units",
    "COMMENT:\\n",
    "GPRINT:transdataavg:MAX:$units Avergage %6.2lf"
  );

 $ret = rrd_graph($output, $options );

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
