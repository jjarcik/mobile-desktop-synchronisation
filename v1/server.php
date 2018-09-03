<?php

session_start();

require 'mysql.php';

$maxtest = 60;
$speed_s = 1;
$speed_n = 100000;

$timeout = 40000;
$speed_s2 = 0;
$speed_n2 = 500000;

date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');

//$counter = rand(1, 10);

$connected = false;
while ($maxtest >  0 && !$connected) {

    $query = "SELECT * FROM my_table WHERE code = '" . $_SESSION["sess"] . "' AND status=1";
    $result = mysql_query($query) or DIE(mysql_error());

    if (mysql_num_rows($result) > 0) {
        $connected = true;
    }

    $maxtest--;    

    echo "event: ping\n";
    echo 'data: {"data": "' . $maxtest . '"}';
    echo "\n\n";

    ob_flush();
    flush();
    time_nanosleep($speed_s, $speed_n);
}

if (!$connected) {
    echo "event: ping\n";
    echo 'data: {"data": "' . "timeout, pleas reload the page" . '"}';
    echo "\n\n";
    exit();
} else {

    echo "event: ping\n";
    echo 'data: {"data": "' . "success" . '"}';
    echo "\n\n";

    ob_flush();
    flush();

    while (1) {

        $query = "SELECT * FROM my_table WHERE code = '" . $_SESSION["sess"] . "'";
        $result = mysql_query($query) or DIE(mysql_error());
        $row = mysql_fetch_array($result);
        $data = $row["data"];
        $data2 = $row["data2"];
        $data3 = $row["data3"];
        echo "event: ping\n";
        echo 'data: {"data": "' . $data . '","data2": "' . $data2 . '","data3": "' . $data3 . '"}';
        echo "\n\n";
        ob_flush();
        flush();
        time_nanosleep($speed_s2, $speed_n2);
        checkTimeOut($timeout--);
    }
}

function checkTimeOut($t) {
    if ($t < 0) {
        echo "event: ping\n";
        echo 'data: {"data": "' . "checkTimeOut exit" . '"}';
        echo "\n\n";
        exit();
    }
}