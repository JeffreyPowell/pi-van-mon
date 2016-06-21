<?php

$height="100";
$width="200";



echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"10\">";
echo "</head><body bgcolor='#FAFAFA'>";

echo "<pre>";

echo shell_exec("date");

echo "<br>";
echo "<h1>messages</h1>";
echo shell_exec("tail -n 20 /var/log/messages");

echo "<br>";
echo "<h1>error.log</h1>";
echo shell_exec("tail -n 20 /var/log/apache2/error.log");

echo "</pre>";

echo "</body></html>";

exit;
