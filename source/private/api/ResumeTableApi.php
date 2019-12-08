<?php

function find_all_resumes()
{
    global $database;

    $sql = "SELECT * FROM ResumeTable";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    return $result;
}

function find_resume_by_id($id)
{
    global $database;

    $sql = "SELECT * FROM ResumeTable ";
    $sql .= "WHERE resume_number='" . mysqli_real_escape_string($database, $id) . "'";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $resume = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $resume;
}

function find_latest_resume_by_user($id) {
	global $database;

    $sql = "SELECT * FROM ResumeTable ";
    $sql .= "WHERE employee_number='" . mysqli_real_escape_string($database, $id) . "' ";
	$sql .= "ORDER BY resume_date DESC LIMIT 1";
    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $resume = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $resume;
}


function create_resume($resume)
{
    global $database;
	
	$stmt = $database->prepare("INSERT INTO ResumeTable (resume_date, resume_content, employee_number) VALUES (?, ?, ?)");
	
	$null = NULL;
	$stmt->bind_param("sbi", 
		$resume['resume_date'], 
		$null, 
		$resume['employee_number']
	);
	$stmt->send_long_data(1, $resume['resume_content']);
	$result = $stmt->execute();

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


function update_resume($resume)
{
    global $database;
    $sql = "UPDATE ResumeTable SET ";
    $sql .= "resume_date='" . mysqli_real_escape_string($database, $resume['resume_date']) . "', ";
    $sql .= "resume_content='" . mysqli_real_escape_string($database, $resume['resume_content']) . "', ";
    $sql .= "employee_number='" . mysqli_real_escape_string($database, $resume['employee_number']) . "'";

    $sql .= " WHERE resume_number='" . mysqli_real_escape_string($database, $resume['resume_number']) . "' LIMIT 1";
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

function delete_resume($id)
{
    global $database;

    $sql = "DELETE FROM ResumeTable ";
    $sql .= "where resume_number='" . mysqli_real_escape_string($database, $id) . "'";
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



