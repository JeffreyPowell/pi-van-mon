<?php

$device_id = $_GET['id'];
$chart_width = $_GET['w'];
$chart_height = $_GET['h'];

if( $device_id == "" )    { $device_id = '1';      header("Location: device-dod.php?id=$device_id&w=$chart_width&h=$chart_height"); exit; }
if( $chart_width == "" )  { $chart_width = '800';  header("Location: device-dod.php?id=$device_id&w=$chart_width&h=$chart_height"); exit; }
if( $chart_height == "" ) { $chart_height = '350'; header("Location: device-dod.php?id=$device_id&w=$chart_width&h=$chart_height"); exit; }


echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"240\">";
echo "<style type='text/css'>a {text-decoration: none}</style>";
echo "</head><body bgcolor='#080808'>";
echo "<a href='devices.php' style='font-family:helvetica;font-size:20px;color:grey;'>All Devices</a><br>";

$config = parse_ini_file('/home/pi/bin/van/www/config.ini', true);

$device_count = count($config['devices']['type']);

if( $device_id > $device_count ) { exit; }

$device_type    = (string) $config['devices']['type'][$device_id];
$device_id      = (string) $config['devices']['id'][$device_id];
$device_pin_num = (string) $config['devices']['pin'][$device_id];
$device_name    = (string) $config['devices']['name'][$device_id];
$device_units   = (string) $config['devices']['units'][$device_id];
  
$img_name = $device_type.'-'.$device_id.'-'.$device_pin_num.'-dod-'.$chart_height.'x'.$chart_width;
$rrd_name = $device_type.'-'.$device_id.'-'.$device_pin_num;

$img_filename = '/home/pi/bin/van/www/images/'.$img_name.'.png';
$rrd_filename = '/home/pi/bin/van/data/'.$rrd_name.'.rrd';

#create_graph_dayonday($DEVICEID, "images/d-dayonday-temp-$DEVICEID.png", "temp",    "( C )",      "AVERAGE", $width, $height);
#echo "<img src='images/d-dayonday-temp-$DEVICEID.png'>";


create_graph_dayonday( $rrd_filename, $img_filename, $device_name.' Day on Day', $device_units, "AVERAGE",$chart_height, $chart_width);

echo "<img src='images/".$img_name.".png' alt='Generated RRD image'><br><br>";
  

echo "</body></html>";

exit;




function create_graph_dayonday($inputrrd, $outputimg, $dataname, $dataunit, $datacf, $height, $width) {

 $red          = "FF0000";
 $red_dark     = "880000";
 $orange       = "FFA500";
 $yellow       = "FFFF00";
 $yellow_dark  = "888800";
 $green        = "00FF00";
 $blue         = "00FFFF";
 $indigo       = "0000FF";
 $violet       = "8D38C9";
 

 $black        = "000000";
 $grey_dark_vv = "161616";
 $grey_dark_v  = "1e1e1e";
 $grey_light   = "c7c7c7";
 $white        = "ffffff";
 
 $days = array(
   0 => $red,
   1 => $orange,
   2 => $yellow,
   3 => $green,
   4 => $blue,
   5 => $indigo,
   6 => $violet
 );

 $titlept=9;
 $linewidth=4;
 $vertaxislabelpt=6;
 $allaxisvaluept=10;
 $legendpt=8;

 $options = array(
   "--alt-y-grid",
  # "--alt-autoscale",
  # "--rigid",
   "--slope-mode",
   "--end=midnight",
   "--start=end-1d",
   "--vertical-label=$dataunit",
   "--height=$height",
   "--width=$width",
   "-cBACK#$grey_dark_vv",
   "-cSHADEA#$black",
   "-cSHADEB#$black",
   "-cFONT#$grey_light",
   "-cCANVAS#$grey_dark_v",
   "-cGRID#$yellow_dark",
   "-cMGRID#$white",
   "-cFRAME#$white",
   "-cARROW#$black",
   "-nTITLE:$titlept",
   "-nLEGEND:$legendpt",
   "-nAXIS:$allaxisvaluept",
   "-nUNIT:$vertaxislabelpt"
 );

 $offset = 60*60*24;

 for ( $DAYID = 0; $DAYID <7; $DAYID ++ ) {

   $DAYNAME  = date( 'D', mktime(0, 0, 0, date("m")  , date("d")-$DAYID, date("Y")));
   $linecol  = $days[$DAYID]."FF";
   $areacol  = $days[$DAYID]."20";
   $DAYSTART = strval(0-$DAYID);
   $DAYEND   = strval(1-$DAYID);
   $DAYSHIFT = strval(($DAYID-1)*$offset);

   $DAYIDST  = strval($DAYID);

   if( $DAYSTART >= 0 ) $DAYSTART ="+".$DAYSTART;
   if( $DAYEND   >= 0 ) $DAYEND   ="+".$DAYEND;

   $DAYSTART = $DAYSTART."d";
   $DAYEND   = $DAYEND."d";

   array_push($options,
     "DEF:a".$DAYIDST."=$inputrrd:data:".$datacf.":start=midnight".$DAYSTART.":end=midnight".$DAYEND,
     "CDEF:b$DAYIDST=a$DAYIDST,1,*",
     "AREA:b$DAYIDST#$areacol"
#      "LINE$linewidth:b$DAYIDST#$linecol:$DAYNAME",
#      "SHIFT:b".$DAYIDST.":".$DAYSHIFT
     );
 }

 for ( $DAYID = 0; $DAYID <7; $DAYID ++ ) {

   $DAYNAME  = date( 'D', mktime(0, 0, 0, date("m")  , date("d")-$DAYID, date("Y")));
   $linecol  = $days[$DAYID]."CC";
   $areacol  = $days[$DAYID]."20";
   $DAYSTART = strval(0-$DAYID);
   $DAYEND   = strval(1-$DAYID);
   $DAYSHIFT = strval(($DAYID-1)*$offset);

   $DAYIDST  = strval($DAYID);

   if( $DAYSTART >= 0 ) $DAYSTART ="+".$DAYSTART;
   if( $DAYEND   >= 0 ) $DAYEND   ="+".$DAYEND;

   $DAYSTART = $DAYSTART."d";
   $DAYEND   = $DAYEND."d";

   array_push($options,
     "LINE$linewidth:b$DAYIDST#$linecol:$DAYNAME",
     "SHIFT:b".$DAYIDST.":".$DAYSHIFT,
     "GPRINT:b$DAYIDST:MIN:min %6.2lf",
     "GPRINT:b$DAYIDST:MAX:max %6.2lf\\n"
     );
 }

$ret = rrd_graph($outputimg, $options);
 if (! $ret) {
   echo "<b>Graph error: </b>".rrd_error()."\n";
 }
}
