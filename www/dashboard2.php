<?php

#create_graph("calls-gw-tok-halfday-wall.png",   "-12h",         "Tokyo calls last 12 hours",             "200", "1100");

echo "<html><head>";
echo "<meta http-equiv='refresh' content='30'>";


$agent = $_SERVER['HTTP_USER_AGENT'];

if (ereg("(iPhone|BlackBerry|PalmSource)", $agent) != false) {
  echo "<meta name='viewport' content='width = device-width'>";
  echo "<link rel='stylesheet' href='mobile.css'>";
  echo "<link rel='apple-touch-icon' href='images/custom_icon.png'>";
}
else {
  echo "<!-- not mobile -->";
  echo "<link href='desktop.css' type='text/css' rel='stylesheet'>";
}

echo "</head><body><div id='screen'>";

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
echo "";
echo "<img src='images/120x240.png'>";
echo "<img src='images/240x120.png'>";

echo "";
echo "";
echo "";
echo "";
echo "";

echo "</div></body></html>";
exit;


?>
