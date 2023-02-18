<?php
$handle = fopen("messages.txt", "r");
$contents = fread($handle, filesize("messages.txt"));
fclose($handle);

$contents = nl2br($contents);
echo $contents;
