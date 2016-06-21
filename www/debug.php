<?php

$height="100";
$width="200";



echo "<html><head>";
echo "<meta http-equiv=\"refresh\" content=\"10\">";
echo "</head><body bgcolor='#FAFAFA'>";

shell_exec("date");

shell_exec("tail /var/log/messages");

shell_exec("ls -l /var/log/");

echo "</body></html>";

exit;
