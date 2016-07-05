<?php

$device_id = $_GET['id'];
$chart_width = $_GET['w'];
$chart_height = $_GET['h'];

if( $device_id == "" )    { $device_id = '1';      header("Location: device-dod.php?id=$device_id&w=$chart_width&h=$chart_height"); exit; }
if( $chart_width == "" )  { $chart_width = '800';  header("Location: device-dod.php?id=$device_id&w=$chart_width&h=$chart_height"); exit; }
if( $chart_height == "" ) { $chart_height = '350'; header("Location: device-dod.php?id=$device_id&w=$chart_width&h=$chart_height"); exit; }



$sensors = file('/home/pi/bin/therm/sensors.txt');

#$charts = array("-30m", "-1h", "-1d", "-1w", "-1m", "-1y");
#$charts = array("-1h", "-1d", "-1w");

echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"240\">";
echo "<style type='text/css'>a {text-decoration: none}</style>";
echo "</head><body bgcolor='#080808'>";
echo "<a href='devices.php' style='font-family:helvetica;font-size:20px;color:grey;'>All Devices</a><br>";

##$height="350";
##$width="800";


create_graph_dayonday($DEVICEID, "images/d-dayonday-temp-$DEVICEID.png", "temp",    "( C )",      "AVERAGE", $width, $height);

echo "<img src='images/d-dayonday-temp-$DEVICEID.png'>";


echo "</body></html>";

exit;




function create_graph_dayonday($DEVICEID, $output, $dataname, $dataunit, $datacf, $width, $height) {

 $red          = "FF0000";
 $orange       = "FFA500";
 $yellow       = "FFFF00";
 $green        = "00FF00";
 $blue         = "00FFFF";
 $indigo       = "0000FF";
 $violet       = "8D38C9";


 $days = array(
   0 => $red,
   1 => $orange,
   2 => $yellow,
   3 => $green,
   4 => $blue,
   5 => $indigo,
   6 => $violet
 );

 $linewidth=2.5;
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
#    "--vertical-label=$dataunit",
   "--height=$height",
   "--width=$width",
   "-cBACK#EEEEEE00",
   "-cSHADEA#EEEEEE00",
   "-cSHADEB#EEEEEE00",
   "-cFONT#000000",
   "-cCANVAS#FFFFFF00",
   "-cGRID#a5a5a5",
   "-cMGRID#FF9999",
   "-cFRAME#5e5e5e",
   "-cARROW#5e5e5e",
   "-nTITLE:9",
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
     "DEF:a".$DAYIDST."=/home/pi/bin/therm/data/sensor-".$DEVICEID."-temp.rrd:data:".$datacf.":start=midnight".$DAYSTART.":end=midnight".$DAYEND,
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

$ret = rrd_graph($output, $options);
 if (! $ret) {
   echo "<b>Graph error: </b>".rrd_error()."\n";
 }
}
