<?php

function find_all_contacts()
{
    global $database;

    $sql = "SELECT * FROM ContactTable";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    return $result;
}

function find_contact_by_id($id)
{
    global $database;

    $sql = "SELECT * FROM ContactTable ";
    $sql .= "WHERE contact_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $contact = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $contact;
}


function create_contact($contact)
{
    global $database;

    $sql = "INSERT INTO ContactTable ";
    $sql .= "(last_name, first_name, middle_name, phone_number, address, email) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($database, $contact['last_name']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $contact['first_name']) . "',";
    $sql .= "'" . mysqli_real_escape_string($database, $contact['middle_name']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $contact['phone_number']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $contact['address']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $contact['email']) . "'";
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


function update_contact($contact)
{
    global $database;
    $sql = "UPDATE ContactTable SET ";
    //$sql .= "contact_number='" . mysqli_real_escape_string($database, $contact['contact_number']) . "', ";
    $sql .= "last_name='" . mysqli_real_escape_string($database, $contact['last_name']) . "', ";
    $sql .= "first_name='" . mysqli_real_escape_string($database, $contact['first_name']) . "', ";
    $sql .= "middle_name='" . mysqli_real_escape_string($database, $contact['middle_name']) . "', ";
    $sql .= "phone_number='" . mysqli_real_escape_string($database, $contact['phone_number']) . "', ";
    $sql .= "address='" . mysqli_real_escape_string($database, $contact['address']) . "', ";
    $sql .= "email='" . mysqli_real_escape_string($database, $contact['email']) . "'";

    $sql .= " WHERE contact_number='" . mysqli_real_escape_string($database, $contact['contact_number']) . "' LIMIT 1";
    $result = mysqli_query($database, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function delete_contact($id)
{
    global $database;

    $sql = "DELETE FROM ContactTable ";
    $sql .= "where contact_number='" . mysqli_real_escape_string($database, $id) . "'";
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



