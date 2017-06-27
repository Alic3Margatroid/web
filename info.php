<?php

echo "Output of the 'whoami' command:<br /><br />\n";

echo exec('/usr/bin/whoami');

echo "<br>".$_SESSION['use'];

?>


