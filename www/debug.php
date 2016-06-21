<?php

$height="100";
$width="200";



echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"10\">";
echo "</head><body bgcolor='#FAFAFA'>";

echo "<pre>";

echo shell_exec("date");

echo "<br>";

echo shell_exec("tail /var/log/messages");

echo "<br>";

#echo shell_exec("ls -l /var/log/");

echo "</pre>";

echo "</body></html>";

exit;
