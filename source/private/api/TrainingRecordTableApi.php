<?php

function find_all_trainingRecords()
{
    global $database;

    $sql = "SELECT * FROM TrainingRecordTable";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    return $result;
}

function find_trainingRecord_by_id($id)
{
    global $database;

    $sql = "SELECT * FROM TrainingRecordTable ";
    $sql .= "WHERE record_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $trainingRecord = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $trainingRecord;
}


function create_trainingRecord($trainingRecord)
{
    global $database;

    $sql = "INSERT INTO TrainingRecordTable ";
    $sql .= "(record_date, record_content, employee_number) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $trainingRecord['record_date']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $trainingRecord['record_content']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $trainingRecord['employee_number']) . "'";
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


function update_trainingRecord($trainingRecord)
{
    global $database;
    $sql = "UPDATE TrainingRecordTable SET ";
    $sql .= "record_date='" . mysqli_real_escape_string($database, $trainingRecord['record_date']) . "', ";
    $sql .= "record_content='" . mysqli_real_escape_string($database, $trainingRecord['record_content']) . "', ";
    $sql .= "employee_number='" . mysqli_real_escape_string($database, $trainingRecord['employee_number']) . "'";

    $sql .= " WHERE record_number='" . mysqli_real_escape_string($database, $trainingRecord['record_number']) . "' LIMIT 1";
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

function delete_trainingRecord($id)
{
    global $database;

    $sql = "DELETE FROM TrainingRecordTable ";
    $sql .= "where record_number='" . mysqli_real_escape_string($database, $id) . "'";
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



