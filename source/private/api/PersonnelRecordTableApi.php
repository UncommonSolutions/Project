<?php

function find_all_personnelRecords()
{
    global $database;

    $sql = "SELECT * FROM PersonnelRecordTable";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    return $result;
}

function find_personnelRecord_by_id($id)
{
    global $database;

    $sql = "SELECT * FROM PersonnelRecordTable ";
    $sql .= "WHERE record_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $personnelRecord = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $personnelRecord;
}


function create_personnelRecord($personnelRecord)
{
    global $database;

    $sql = "INSERT INTO PersonnelRecordTable ";
    $sql .= "(record_date, event_record, employee_number) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $personnelRecord['record_date']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $personnelRecord['event_record']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $personnelRecord['employee_number']) . "'";
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


function update_personnelRecord($personnelRecord)
{
    global $database;
    $sql = "UPDATE PersonnelRecordTable SET ";
    $sql .= "record_date='" . mysqli_real_escape_string($database, $personnelRecord['record_date']) . "', ";
    $sql .= "event_record='" . mysqli_real_escape_string($database, $personnelRecord['event_record']) . "', ";
    $sql .= "employee_number='" . mysqli_real_escape_string($database, $personnelRecord['employee_number']) . "'";

    $sql .= " WHERE record_number='" . mysqli_real_escape_string($database, $personnelRecord['record_number']) . "' LIMIT 1";
    echo $sql;
    $result = mysqli_query($database, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function delete_personnelRecord($id)
{
    global $database;

    $sql = "DELETE FROM PersonnelRecordTable ";
    $sql .= "WHERE record_number='" . mysqli_real_escape_string($database, $id) . "'";
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



