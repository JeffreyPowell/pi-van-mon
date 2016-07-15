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


echo "<div style='background-color:#000000; height: 100%; width: 100%; border: 0px dashed yellow;'>";
echo "<table style='width:100%; border: 0px dashed blue;'><tr>";

#========== Column Left

echo "<td style='width:1%; border: 0px dashed green; text-align: left; vertical-align: middle;'>";
#echo "<div style='display: block; position: relative; width: 100%; height: 100%; border: 1px solid orange;'>";

#---------- Main battery status

  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 1;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; width: 100px; height: 100px; border: 2px dashed red;' src='images/battery-wht.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  $device_id      = 9;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

#---------- Hookup charger status

  #echo "<div style='position: relative; top: 000px;	left: 000px; height: 100px; width: 200px; background-color:#242424; background-image: url(images/none.png); border: 5px solid yellow;'>";
  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 2;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  $device_id      = 10;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

#---------- Solar panel 1 status

  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 3;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

#---------- Solar panel 2 status

  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 4;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

#---------- Wind charger status
/*
  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 5;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";
*/
echo "</td>";

echo "<td style='width: 33%'></td>";

#========== Column Left Mid

echo "<td style='width:1%; border: 0px dashed green; text-align: left; vertical-align: middle;'>";

  echo "<div style='position: static; height: 100px; width: 100px; background-color:#242424; background-image: url(images/none.png); border: 0px solid yellow;'>";
  $device_id      = 14;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

echo "</td>";

echo "<td style='width: 33%'></td>";

#========== Column Center

echo "<td style='width:1%; border: 0px dashed green; text-align: left; vertical-align: middle;'>";

#---------- Split battery status

  echo "<div style='position: static; height: 300px; width: 300px; background-color:#242424; background-image: url(images/none.png); border: 0px solid yellow;'>";
  $device_id      = 6;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];

  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );

  $period_span    = '-1h';
  $chart_width    = 160;
  $chart_height   = 100;
  $img_name = $device_type.'-'.$device_ref.'-'.$device_pin_num.$period_span.'-'.$chart_height.'x'.$chart_width;
  $img_filename = '/home/pi/bin/van/www/images/'.$img_name.'.png';
  create_graph( $rrd_filename, $img_filename,  $period_span, $device_name.' '.$period_span, $device_units, $chart_height, $chart_width);

  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "<img  style='position: relative; top: 100px; left: 020px;' src='images/$img_name.png' >";
  echo "</div>";

echo "</td>";

echo "<td style='width: 33%'></td>";

#========== Column Right Mid
echo "<td style='width:1%; border: 0px dashed green; text-align: left; vertical-align: middle;'>";

  echo "<div style='position: static; height: 100px; width: 100px; background-color:#242424; background-image: url(images/none.png); border: 0px solid yellow;'>";
  $device_id      = 14;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

echo "</td>";

echo "<td style='width: 33%'></td>";

#========== Column Right
echo "<td style='width:1%; border: 0px dashed green; text-align: left; vertical-align: middle;'>";

#---------- Fridge status

  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 14;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

#---------- 12v Sockets status

  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 15;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

#---------- 240v Sockets status

  echo "<div style='position: static; top: 0;	left: 0; height: 100px; width: 200px; background-color:#242424; border: 2px solid black;'>";
  $device_id      = 16;
  $device_type    = (string) $config['devices']['type'][$device_id];
  $device_ref     = (string) $config['devices']['ref'][$device_id];
  $device_pin_num = (string) $config['devices']['pin'][$device_id];
  $device_name    = (string) $config['devices']['name'][$device_id];
  $device_units   = (string) $config['devices']['units'][$device_id];
  $rrd_name       = $device_type.'-'.$device_ref.'-'.$device_pin_num;
  $rrd_filename   = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';
  $last_value     = round( read_last_value($rrd_filename), 2 );
  echo "<img  style='position: relative; top: 000px; left: 000px; border: 0px solid red;' src='images/none.png'>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:18px; color:white;'>$device_name</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:12px; color:white;'>$last_value</span>";
  echo "<span style='position: relative; top: 000px; left: 000px; border: 0px solid red; font-family:sans-serif; font-size:09px; color:white;'>$device_units</span>";
  echo "</div>";

echo "</td>";

echo "</tr></table>";
echo "</div>";




echo "</body></html>";
exit;

function create_graph($input, $output, $start, $title, $units, $height, $width) {

  $options = array(
    "--slope-mode",
    "--start", $start,
#    "--title=$title",
#    "--vertical-label=$units",
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
#    "-nTITLE:10",
#    "-nAXIS:0",
    "-nUNIT:10",
    "-y 0.2:5",
    "-cFRAME#ffffff",
    "-cARROW#000000",
    "DEF:dataavg=$input:data:AVERAGE",
    "CDEF:transdataavg=dataavg,1,*",
    "AREA:transdataavg#b6d14b40",
    "LINE2:transdataavg#a0b842"
#    "LINE4:transdataavg#a0b842:$title $units"
#    "COMMENT:\\n",
#    "GPRINT:transdataavg:MAX:$units Avergage %6.2lf"
  );

 $ret = rrd_graph($output, $options );

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

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
