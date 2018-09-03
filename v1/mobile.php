<?php

session_start();
if (isset($_POST["code"])) {
    require 'mysql.php';
    $query = "UPDATE my_table set data='" . $_POST["data"] . "', data2='" . $_POST["data2"] . "', data3='" . $_POST["data3"] . "' WHERE code = '" . $_POST["code"] . "'";
    $result = mysql_query($query) or DIE(mysql_error());
}
