<?php

function find_job_by_id($id) {
	global $database;

    $sql = "SELECT * FROM JobTable ";
    $sql .= "WHERE job_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $job = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $job;
}

function update_job($job)
{
    global $database;
    $sql = "UPDATE JobTable SET ";
    $sql .= "position_name='" . mysqli_real_escape_string($database, $job['position_name']) . "', ";
    $sql .= "position_description='" . mysqli_real_escape_string($database, $job['position_description']) . "' ";

    $sql .= " WHERE job_number='" . mysqli_real_escape_string($database, $job['job_number']) . "' LIMIT 1";
    $result = mysqli_query($database, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function create_job($job)
{
    global $database;

    $sql = "INSERT INTO JobTable ";
    $sql .= "(position_name, position_description) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $job['position_name']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $job['position_description']) . "'";
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