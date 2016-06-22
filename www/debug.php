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

echo "<div id='device'>";

echo "<div>";
echo "This is page heading";
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
echo "";
echo "<img src='images/120x240.png'>";
echo "<img src='images/240x120.png'>";

echo "";
echo "";
echo "";
echo "";
echo "";

echo "</body></html>";
exit;

?>
