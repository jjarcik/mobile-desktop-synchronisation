<?php

if (@mysql_connect("localhost","user","password")) {
    if (mysql_select_db("database")) {
        $result = mysql_query("SET CHARACTER Set utf8");
        if (!$result) {
            die(mysql_error());
        }
    } else {
        die("DATABASE ERROR" . mysql_error());
    }
} else {
    die("CONNECTION ERROR" . mysql_error());
}

?>
