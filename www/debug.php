<?php
$height="100";
$width="200";

echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"10\">";
echo "<link rel='stylesheet' href='debug.css'>";
echo "</head><body>";

echo "<h1>";
echo shell_exec("date");
echo "</h1>";

echo "<br>";
echo "<h1>one wire</h1>";
echo "<div id='code'>";
echo shell_exec("ls -l /sys/bus/w1/devices");
echo "</div>";

echo "<br>";
echo "<h1>i2c</h1>";
echo "<div id='code'>";
echo shell_exec("sudo /usr/sbin/i2cdetect -y 1");
echo "</div>";

echo "<br>";
echo "<h1>messages</h1>";
echo "<div id='code'>";
echo shell_exec("tail -n 20 /var/log/messages");
echo "</div>";

echo "<br>";
echo "<h1>error.log</h1>";
echo "<div id='code'>";
echo shell_exec("tail -n 20 /var/log/apache2/error.log");
echo "</div>";

echo "<br>";
echo "<h1>access.log</h1>";
echo "<div id='code'>";
echo shell_exec("tail -n 20 /var/log/apache2/access.log");
echo "</div>";

echo "</body></html>";

exit;
?>
