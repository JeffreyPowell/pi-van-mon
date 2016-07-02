<?php

#create_graph("calls-gw-tok-halfday-wall.png",   "-12h",         "Tokyo calls last 12 hours",             "200", "1100");

echo "<html><head>";
echo "<meta http-equiv='refresh' content='30'>";
echo "<style>";
echo "body {background-color:white; border:1px solid red; padding:5px; font-family:sans-serif;}";
#echo "#header {padding:5px; font-family:sans-serif; font-size:22px; text-align:center; color:white; background-color:black;}";
#echo "#nav {border:1px solid red; padding:5px; font-family:sans-serif; font-size:12px; text-align:center; display: block; background-color:yellow;}";
echo "#p01 {color: blue;}";
echo "</style>";
echo "</head><body>";


echo "<br>";
echo "<h1>access.log</h1>";

echo "<div id='code'>";
echo shell_exec("tail -n 20 /var/log/apache2/access.log");
echo "</div>";


echo "</body></html>";
exit;

?>
