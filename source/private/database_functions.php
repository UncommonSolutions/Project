<?php


function db_connect() {
    $configPath = dirname($_SERVER['DOCUMENT_ROOT'], 1);
    $db_credentials = include($configPath . "/config.php");

    $connection = mysqli_connect($db_credentials['db_host'], $db_credentials['db_user'], $db_credentials['db_pass'], $db_credentials['db_name']);
    confirm_db_connect();
    return $connection;
}

function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set) {
    if(!$result_set) {
        exit("Database query failed.");
    }
}
