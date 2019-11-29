<?php
require_once(__DIR__ . '/../initialize.php');

function find_all_users() {
    global $database;

    $sql = "SELECT * FROM UserLoginTable";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    return $result;
}

function find_user_by_id($id) {
     global $database;

     $sql = "SELECT * FROM UserLoginTable ";
     $sql .= "WHERE user_number='" . mysqli_real_escape_string($database, $id) . "'";
     $result = mysqli_query($database, $sql);
     confirm_result_set($result);
     $user = mysqli_fetch_assoc($result);
     mysqli_free_result($result);
     return $user;
 }
 
function find_user_by_name($username) {
     global $database;

     $sql = "SELECT * FROM UserLoginTable ";
     $sql .= "WHERE user_name='" . mysqli_real_escape_string($database, $username) . "'";
     $result = mysqli_query($database, $sql);
     confirm_result_set($result);
     $user = mysqli_fetch_assoc($result);
     mysqli_free_result($result);
     return $user;
 }

function create_user($user) {
    global $database;

    //$hashed_password = password_hash($user['hashed_password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO UserLoginTable ";
    $sql .= "(user_number, user_name, access_level, password_hash, last_login) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $user['user_number']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $user['user_name']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $user['access_level']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $user['password_hash']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $user['last_login']) . "'";
    $sql .= ")";
    $result = mysqli_query($database, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}


 function update_user($user) {
     global $database;
     $sql = "UPDATE UserLoginTable SET ";
     $sql.= "user_number='" . mysqli_real_escape_string($database, $user['user_number']) . "', ";
     $sql.= "user_name='" . mysqli_real_escape_string($database, $user['user_name']) . "', ";
     $sql.= "access_level='" . mysqli_real_escape_string($database, $user['access_level']) . "', ";
     $sql.= "password_hash='" . mysqli_real_escape_string($database, $user['password_hash']) . "', ";
     $sql.= "last_login='" . mysqli_real_escape_string($database, $user['last_login']) . "'";

     $sql .= " WHERE user_number = '" . mysqli_real_escape_string($database, $user['user_number']) . "' LIMIT 1";

    $result = mysqli_query($database, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function delete_user($id) {
    global $database;

    $sql = "DELETE FROM UserLoginTable ";
    $sql .= "where user_number='" . mysqli_real_escape_string($database, $id) . "'";
    $sql .= "LIMIT 1";

    $result = MYSQLI_QUERY($database, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}