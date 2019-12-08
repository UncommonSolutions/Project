<?php

function find_all_personnel()
{
    global $database;

    $sql = "SELECT * FROM PersonnelTable";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    return $result;
}

function find_personnel_by_id($id)
{
    global $database;

    $sql = "SELECT * FROM PersonnelTable ";
    $sql .= "WHERE employee_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $personnel = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $personnel;
}

function find_personnel_by_user_id($id)
{
    global $database;

    $sql = "SELECT * FROM PersonnelTable ";
    $sql .= "WHERE user_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $personnel = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $personnel;
}


function create_personnel($personnel)
{
    global $database;

    $sql = "INSERT INTO PersonnelTable ";
    $sql .= "(user_number, ssn, personal_contact_number, emergency_contact_number, job_number, group_number) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $personnel['user_number']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $personnel['ssn']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $personnel['personal_contact_number']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $personnel['emergency_contact_number']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $personnel['job_number']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $personnel['group_number']) . "'";
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


function update_personnel($personnel)
{
    global $database;
    $sql = "UPDATE PersonnelTable SET ";
    $sql .= "user_number='" . mysqli_real_escape_string($database, $personnel['user_number']) . "', ";
    $sql .= "ssn='" . mysqli_real_escape_string($database, $personnel['ssn']) . "', ";
    $sql .= "personal_contact_number='" . mysqli_real_escape_string($database, $personnel['personal_contact_number']) . "', ";
    $sql .= "emergency_contact_number='" . mysqli_real_escape_string($database, $personnel['emergency_contact_number']) . "', ";
    $sql .= "job_number='" . mysqli_real_escape_string($database, $personnel['job_number']) . "', ";
    $sql .= "group_number='" . mysqli_real_escape_string($database, $personnel['group_number']) . "'";

    $sql .= " WHERE employee_number='" . mysqli_real_escape_string($database, $personnel['employee_number']) . "' LIMIT 1";
    $result = mysqli_query($database, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function delete_personnel($id)
{
    global $database;

    $sql = "DELETE FROM PersonnelTable ";
    $sql .= "WHERE employee_number='" . mysqli_real_escape_string($database, $id) . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($database, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}



