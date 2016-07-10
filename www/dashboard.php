<?php

#create_graph("calls-gw-tok-halfday-wall.png",   "-12h",         "Tokyo calls last 12 hours",             "200", "1100");

$dash_id = $_GET['id'];
$chart_width = $_GET['w'];
$chart_height = $_GET['h'];

if( $dash_id      == "" ) { $dash_id      = '1';             header("Location: device-dod.php?id=$device_index&w=$chart_width&h=$chart_height"); exit; }
if( $chart_width  == "" ) { $chart_width  = $default_width;  header("Location: device-dod.php?id=$device_index&w=$chart_width&h=$chart_height"); exit; }
if( $chart_height == "" ) { $chart_height = $default_height; header("Location: device-dod.php?id=$device_index&w=$chart_width&h=$chart_height"); exit; }

$config = parse_ini_file('/home/pi/bin/van/www/config2.ini', true);

$dash_count = count($config['dashboard']['type']);

echo "<html><head>";
echo "<meta http-equiv='refresh' content='300'>";
echo "<style>";
echo "body {background-color:#080808;}";
echo "#header {padding:5px; font-family:sans-serif; font-size:22px; text-align:center; color:white; background-color:black;}";
echo "#nav {border:1px solid red; padding:5px; font-family:sans-serif; font-size:12px; text-align:center; display: block; background-color:yellow;}";
echo "#p01 {color: blue;}";
echo "</style>";
echo "</head><body>";

echo "<div id='header'>";
echo "This is page heading";
echo "<div>";
echo "</div>";
echo "</div>";
echo "<div id='nav'>";
echo "<table id='nav'><tr>";
echo "<td><a href='#'>Home</a></td>";
echo "<td><a href='#'>About Us</a></td>";
echo "<td><a href='#'>Contact Us</a></td>";
echo "</tr></table></div>";

#echo "<img src='calls-gw-tok-halfday-wall.png'>";
echo "<p id='p01'>I am different</p>";
echo "<table><tr>";
echo "<td>";
echo "<img src='images/120x240.png'><br>";
echo "<img src='images/120x240.png'><br>";
echo "<img src='images/120x240.png'>";
echo "</td>";
echo "<td></td>";
echo "<td>";
echo "<img src='images/240x120.png'>";
echo "<img src='images/240x120.png'>";
echo "<img src='images/240x120.png'>";
echo "</td>";
echo "<td>";
echo "<img src='images/120x240.png'><br>";
echo "<img src='images/120x240.png'><br>";
echo "<img src='images/120x240.png'>";
echo "</td>";
echo "";
echo "";
echo "";
echo "";
echo "</tr></table>";

echo "</body></html>";
exit;

function create_graph($output, $start, $title, $height, $width) {

  $options = array(
    "--slope-mode",
    "--start", $start,
    "--title=$title",
    "--vertical-label=Calls",
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
    "DEF:callmax=/usr/local/scripts/git/jcall2/data/jcall-gw-tok.rrd:callstot:MAX",
    "CDEF:transcalldatamax=callmax,1,*",
    "AREA:transcalldatamax#a0b84240",
    "LINE4:transcalldatamax#a0b842:Calls",
    "COMMENT:\\n",
#    "GPRINT:transcalldatamax:LAST:Calls Now %6.2lf",
    "GPRINT:transcalldatamax:MAX:Calls Max %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
