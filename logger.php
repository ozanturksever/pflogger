<?php

$fp = fopen("php://stdin", "r");
$packet = '';
openlog("pf",  LOG_NDELAY, LOG_LOCAL0);
while (!feof($fp)) {
    $line = fgets($fp, 1024);
    if (is_numeric(substr($line, 0, 2))) {
        print ".";
        syslog(LOG_INFO ,$packet);
        unset($packet);
        $packet = '';
    }
    if ($packet != '') {
        $packet .= ", ";
    }
    $packet .= trim($line);
}