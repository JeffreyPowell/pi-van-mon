<?php

#create_graph("calls-gw-tok-halfday-wall.png",   "-12h",         "Tokyo calls last 12 hours",             "200", "1100");
$default_width = 300;
$default_height = 300;

$dash_id = $_GET['id'];
$chart_width = $_GET['w'];
$chart_height = $_GET['h'];

if( $dash_id      == "" ) { $dash_id      = '1';             header("Location: dashboard.php?id=$dash_id&w=$chart_width&h=$chart_height"); exit; }
if( $chart_width  == "" ) { $chart_width  = $default_width;  header("Location: dashboard.php?id=$dash_id&w=$chart_width&h=$chart_height"); exit; }
if( $chart_height == "" ) { $chart_height = $default_height; header("Location: dashboard.php?id=$dash_id&w=$chart_width&h=$chart_height"); exit; }

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

$dash_count = count($config['dashboard']['name']);

echo "<html><head>";
echo "<meta http-equiv='refresh' content='300'>";
echo "<style>";
echo "body {background-color:#080808;}";
echo "#header {padding:5px; font-family:sans-serif; font-size:22px; text-align:center; color:white; background-color:black;}";
echo "#nav {border:1px solid red; padding:5px; font-family:sans-serif; font-size:12px; text-align:center; display: block; background-color:yellow;}";
echo "#p01 {color: blue;}";
echo "</style>";
echo "</head><body>";

#echo "<div id='header'>";
#echo "This is page heading";
#echo "<div>";
#echo "</div>";
#echo "</div>";
#echo "<div id='nav'>";
#echo "<table id='nav'><tr>";
#echo "<td><a href='#'>Home</a></td>";
#echo "<td><a href='#'>About Us</a></td>";
#echo "<td><a href='#'>Contact Us</a></td>";
#echo "</tr></table></div>";

#echo "<img src='calls-gw-tok-halfday-wall.png'>";
#echo "<p id='p01'>I am different</p>";

echo "<div style='background-color:#000000; height: 100%; width: 100%; border: 1px dashed yellow;'>";
echo "<table style='width:100%; border: 3px dashed blue;'><tr>";
echo "<td style='width:30px; border: 1px dashed blue;'";
echo "<td style='width:05px; border: 1px dashed blue;'";
echo "<td style='width:30px; border: 1px dashed blue;'";
echo "<td style='width:05px; border: 1px dashed blue;'";
echo "<td style='width:30px; border: 1px dashed blue;'";
echo "</tr></table>";
echo "</div>";




echo "<table><tr>";
echo "<td>";

$device_id      = 14;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/none.png); height: 120px; width: 240px; border: 5px solid yellow;'>";
echo "<p style='display: inline; border: 1px solid red; font-family:sans-serif; font-size:12px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";
echo "</div>";

$device_id      = 1;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/none.png); height: 120px; width: 120px; border: 5px solid yellow;'>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:12px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";

echo "</div>";

$device_id      = 1;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/none.png); height: 120px; width: 120px; border: 5px solid yellow;'>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:12px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";

echo "</div>";

$device_id      = 14;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/none.png); height: 120px; width: 240px; border: 5px solid yellow;'>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:12px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";

echo "</div>";

echo "</td>";

echo "<td>";

$device_id      = 1;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/none.png); height: 120px; width: 120px; border: 5px solid yellow;'>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:12px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";

echo "</div>";

echo "</td>";

echo "<td>";

$device_id      = 16;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/none.png); height: 360px; width: 360px; border: 5px solid yellow;'>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:18px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";
echo "</div>";
echo "</td>";


echo "<td>";
$device_id      = 3;
$device_type    = (string) $config['devices']['type'][$device_id];
$device_ref     = (string) $config['devices']['ref'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
$rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
$rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
$last_value     = read_last_value($rrd_filename);
echo "<div style='display: inline; background-color:#242424; background-image: url(images/240x120.png); height: 120px; width: 120px; border: 5px solid yellow;'>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:12px; text-align:center; color:white;'>$device_name</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$last_value</p>";
echo "<p style='border: 1px solid red; font-family:sans-serif; font-size:09px; text-align:center; color:white;'>$device_units</p>";
echo "</div>";
echo "</td>";

echo "<td>";

echo "<div style='display: inline; background-color:#242424; background-image: url(images/120x240.png); height: 120px; width: 240px; border: 1px solid yellow;'>";
echo "Bone";
echo "</div>";
#echo "<br>";

echo "<div style='display: inline; background-color:#242424; background-image: url(images/120x240.png); height: 120px; width: 240px; border: 1px solid yellow;'>";
echo "Btwo";
echo "</div>";

echo "<div style='display: inline; background-color:#242424; background-image: url(images/120x240.png); height: 120px; width: 240px; border: 1px solid yellow;'>";
echo "Bthree";
echo "</div>";

echo "</td>";

echo "</tr></table>";
echo "</body></html>";
exit;



function read_last_value($rrd_filename) {

 $ret = rrd_lastupdate( $rrd_filename );

  if (! $ret) {
    echo "<b>Read error: </b>".rrd_error()."\n";
  }
  $data = $ret['data'][0];

  #print_r( "X" );
  #print_r( $ret );
  #print_r( $data );
  #print_r( "X" );

  return $data;
}
?>
