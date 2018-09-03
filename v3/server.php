<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');

$key = 0;
$project = "/pushdata.php";
$shm_key = ftok($project, 'P');



//echo "event: msg" . PHP_EOL;
//echo 'data: {"data": "' . $counter . '"}' . PHP_EOL;
//echo "\n";

/**/
$counter = 0;
while (1) {

    // if ((time() - $startedAt) > 10) { die(); }
    //$curDate = date(DATE_ISO8601);
    $pointer = shm_attach($shm_key);
    if (shm_has_var($pointer, $key)) {
        $counter = shm_get_var($pointer, $key);
        echo "event: msg" . PHP_EOL;
        echo 'data: {"data": "' . $counter . '"}' . PHP_EOL;
        echo "\n";
        ob_flush();
        flush();
    }
    shm_detach($pointer);

    sleep(1);
}



/**/