<?php

$DEVICEID = $_GET['id'];


#$DEVICEID = "28-000005d01306";


$sensors = file('/home/pi/bin/therm/sensors.txt');

#$charts = array("-30m", "-1h", "-1d", "-1w", "-1m", "-1y");
#$charts = array("-1h", "-1d", "-1w");

echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"240\">";
echo "<style type='text/css'>a {text-decoration: none}</style>";
echo "</head><body bgcolor='#080808'>";
echo "<a href='devices.php' style='font-family:helvetica;font-size:20px;color:grey;'>All Devices</a><br>";

$height="350";
$width="800";

#$duration="-1d";
create_graph_dayonday($DEVICEID, "images/d-dayonday-temp-$DEVICEID.png", "temp",    "( C )",      "AVERAGE", $width, $height);
echo "<img src='images/d-dayonday-temp-$DEVICEID.png'>";


echo "<table style='font-family:helvetica;font-size:16px;color:grey;'>";
echo "<tr>";

foreach ($sensors as $sensor) {

 echo "<td><img src='images/thermometer.png'></td>";

 $DEVICEID=explode(" ", $sensor)[0];
 $DEVICENAME=explode(" ", $sensor)[1];
 $DEVICECOLOUR=substr(explode(" ", $sensor)[2],0,6);
 $DEVICEDATA=file("/home/pi/bin/therm/data/sensor-$DEVICEID-temp.txt");
 $TEMP=substr($DEVICEDATA[0],0,4);


 echo "<td width=300>";
 echo "<a href='dayonday.php?id=$DEVICEID'>";
 echo "<div style='font-family:helvetica;font-size:20px;color:grey;'>$DEVICENAME</div>";
 echo "<div style='font-family:helvetica;font-size:82px;color:$DEVICECOLOUR;'>$TEMP</div>";
 echo "</a>";
 echo "</td>";

}

echo "</tr>";




#echo "<table style='font-family:helvetica;font-size:16px;color:grey;'>";

$height="100";
$width="200";

/*
foreach ($charts as $duration) {

 echo "<tr>";

 foreach ($sensors as $sensor) {

   $DEVICEID=explode(" ", $sensor)[0];
   $DEVICENAME=explode(" ", $sensor)[1];
   $DEVICECOLOUR=substr(explode(" ", $sensor)[2],0,6);
   $col1line=$DEVICECOLOUR."FF";
   $col1area=$DEVICECOLOUR."20";

   create_graph1("$DEVICEID", "images/d-$DEVICEID-temp$duration.png", $duration, "temp",    "( C )",      "AVERAGE", $width, $height, $col1line, $col1area);
   echo "<td colspan=2><img src='images/d-$DEVICEID-temp$duration.png'></td>";
 }

 echo "</tr>";
}
*/

echo "</table>";

echo "</body></html>";

exit;



function create_graph1($datafile, $output, $start, $dataname, $dataunit, $datacf, $width, $height, $linecol, $areacol) {

$linewidth=1.5;

$vertaxislabelpt=6;
$allaxisvaluept=6;
$legendpt=6;

 $options = array(
#    "--alt-autoscale",
   "--slope-mode",
   "--start", $start,
#    "--title=$title",
   "--vertical-label=$dataunit",
#    "--lower=0",
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
#    "-R normal",
   "-nTITLE:9",
   "-nTITLE:9",
   "-nLEGEND:$legendpt",
   "-nAXIS:$allaxisvaluept",
   "-nUNIT:$vertaxislabelpt",
   "DEF:a=/home/pi/bin/therm/data/sensor-$datafile-temp.rrd:data:$datacf",
   "CDEF:b=a,1,*",
   "AREA:b#$areacol",
   "LINE$linewidth:b#$linecol:$dataname",
#    "COMMENT:\\n",
   "GPRINT:b:MIN:min %6.2lf",
   "GPRINT:b:MAX:max %6.2lf\\n"
);

$ret = rrd_graph($output, $options);
 if (! $ret) {
   echo "<b>Graph error: </b>".rrd_error()."\n";
 }
}


function create_graph_multi($sensors, $output, $start, $dataname, $dataunit, $datacf, $width, $height) {

$linewidth=2.5;

$vertaxislabelpt=6;
$allaxisvaluept=6;
$legendpt=8;

$options = array(
   "--slope-mode",
   "--start", $start,
   "--vertical-label=$dataunit",
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

foreach ( $sensors as $sensor ) {

   $DEVICEID=explode(" ", $sensor)[0];
   $DEVICENAME=explode(" ", $sensor)[1];
   $DEVICECOLOUR=substr(explode(" ", $sensor)[2],0,6);
   $linecol=$DEVICECOLOUR."FF";
   $areacol=$DEVICECOLOUR."20";
   array_push($options,
   "DEF:a$DEVICEID=/home/pi/bin/therm/data/sensor-$DEVICEID-temp.rrd:data:$datacf",
   "CDEF:b$DEVICEID=a$DEVICEID,1,*",
   "AREA:b$DEVICEID#$areacol",
   "LINE$linewidth:b$DEVICEID#$linecol:$DEVICENAME",
   "GPRINT:b$DEVICEID:MIN:min %6.2lf",
   "GPRINT:b$DEVICEID:MAX:max %6.2lf\\n");
}

$ret = rrd_graph($output, $options);
 if (! $ret) {
   echo "<b>Graph error: </b>".rrd_error()."\n";
 }
}

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
