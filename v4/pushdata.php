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
    $stack = shm_get_var($pointer,$key);
}

$stack[] = array("time"=>time(),"x"=>rand(0, 640),"y"=>rand(0, 640));

shm_put_var($pointer, $key, $stack); // Save the data in shared memory
print_r(shm_get_var($pointer, $key));

// IF COUNT STACK > XYZ SAFE TO DATABASE AND CLEAR EVERY ITEM WITH TIME > T1


echo "<br />ok";

shm_detach($pointer); 
