<?php
/*
 * OUTPUT FILE 
 * 
 * 
 * 
 * 
 **/

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
while (1) {

    // if ((time() - $startedAt) > 10) { die(); }
    //$curDate = date(DATE_ISO8601);
    $pointer = shm_attach($shm_key);
    if (shm_has_var($pointer, $key)) {
        $stack = shm_get_var($pointer, $key);                        
        
        
        foreach ($stack as $k=>$value) {
            if (time() - $value["time"] > 3){
                unset($stack[$k]);                
            }
        }
        
        echo "event: msg" . PHP_EOL;
        echo 'data: {"data": ' . json_encode($stack) . '}' . PHP_EOL;
        echo "\n";
        ob_flush();
        flush();
    }
    shm_detach($pointer);

    sleep(0.1);
}



/**/