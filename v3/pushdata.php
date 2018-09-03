<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set("America/New_York");

$counter  = 0;
$key = 0;
$project = "/pushdata.php";

$shm_key = ftok($project,'P');
$pointer =  shm_attach($shm_key); 

if (shm_has_var($pointer, $key)){
    $counter = shm_get_var($pointer,$key);
}
$counter++;

shm_put_var($pointer, $key, $counter); // Save the data in shared memory
shm_detach($pointer); 
echo "ok";
