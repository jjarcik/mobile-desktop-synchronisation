<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set("America/New_York");

$stack = array();
$key = 0;
$project = "/pushdata.php";

$shm_key = ftok($project,'P');
$pointer =  shm_attach($shm_key); 

if (shm_has_var($pointer, $key)){
    $stack = shm_remove_var($pointer,$key);
}
echo "clear ok";

shm_detach($pointer); 
