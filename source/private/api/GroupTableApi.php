<?php

function find_group_by_id($id) {
	global $database;

    $sql = "SELECT * FROM GroupTable ";
    $sql .= "WHERE group_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $group = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $group;
}

function create_group($group)
{
    global $database;

    $sql = "INSERT INTO GroupTable ";
    $sql .= "(group_name) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $group['group_name']) . "'";
    $sql .= ")";
    $result = mysqli_query($database, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

?>