<?php
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

function find_user_by_username($username) {
    global $database;

    $sql = "SELECT * FROM UserLoginTable ";
    $sql .= "WHERE user_name = '" . mysqli_real_escape_string($database, $username) . "'";

    $result = mysqli_query($database, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}


function create_user($user) {
    global $database;

    // hash password before inserting record
	//Password is hashed in assist/createUser.php
    //$password_hash = password_hash($user['password_hash'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO UserLoginTable ";
    $sql .= "(user_name, access_level, password_hash, last_login) ";
    $sql .= "VALUES (";
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

    $result = mysqli_query($database, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function set_last_login($id) {
    global $database;

    $sql = "UPDATE UserLoginTable SET ";
    $sql .= "last_login=CURRENT_TIMESTAMP ";
    $sql .= "WHERE user_number='" . mysqli_real_escape_string($database, $id) . "'";

    $result = mysqli_query($database, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function create_access_log($user, $isSuccess) {
    global $database;
    $sql = "INSERT INTO AccessLogTable";
    $sql .= "(login_success, user_number) ";
    $sql .= "VALUES(";
    $sql .= "'" . mysqli_real_escape_string($database, $isSuccess) . "', ";
    $sql .= "'" . mysqli_real_escape_string($database, $user) . "'";
    $sql .= ")";

    $result = mysqli_query($database, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($database);
        db_disconnect($database);
        exit;
    }
}

function create_all_user_entries($user, $personnel) {
	global $database;
	
	create_user($user);
	$user_id = $database->insert_id;
	create_contact([
		"last_name" => $personnel["last_name"], 
		"first_name" => $personnel["first_name"], 
		"middle_name" => $personnel["middle_name"], 
		"phone_number" => "", 
		"address" => "", 
		"email" => ""
	]);
	$contact_id = $database->insert_id;
	create_contact([
		"last_name" => "", 
		"first_name" => "", 
		"middle_name" => "", 
		"phone_number" => "", 
		"address" => "", 
		"email" => ""
	]);
	$emergency_contact_id = $database->insert_id;
	create_job([
		"position_name" => "", 
		"position_description" => ""
	]);
	$job_id = $database->insert_id;
	create_group([
		"group_name" => ""
	]);
	$group_id = $database->insert_id;
	
	create_personnel([
		"user_number" => $user_id, 
		"ssn" => "", 
		"personal_contact_number" => $contact_id, 
		"emergency_contact_number" => $emergency_contact_id, 
		"job_number" => $job_id, 
		"group_number" => $group_id
	]);
	
	return true;
}