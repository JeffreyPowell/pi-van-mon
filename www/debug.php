<?php

$height="100";
$width="200";



echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"10\">";
echo "</head><body bgcolor='#FAFAFA'>";

exec("date");

exec("tail /var/log/messages");

exec("ll /var/log/");

echo "</body></html>";

exit;
