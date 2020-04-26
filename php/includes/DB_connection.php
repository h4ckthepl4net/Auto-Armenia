<?php
require $_SERVER['DOCUMENT_ROOT']."/php/configs/DB_config.php";
$mySqlConnection = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($mySqlConnection->connect_error) {
    die("Connection failed: " . $mySqlConnection->connect_error);
    // TODO don't print error with die
}