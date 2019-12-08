<?php
SESSION_START();
require("../includes/security.php");
require_once("../private/initialize.php");

$response = [];
$response['success'] = FALSE;
$response['error'] = 0;
$response['message'] = 'This has not been overwritten...';

function setResponse($s, $e, $m) {
	global $response;
	$response['success'] = $s;
	$response['error'] = $e;
	$response['message'] = $m;
}

function returnCurrentResponse() {
	global $response;
	
	echo json_encode($response);
	exit();
}

function returnWithResponse($s, $e, $m) {
	setResponse($s, $e, $m);
	returnCurrentResponse();
}

/*********************************************************************************************************/

if (!isLoggedIn() || !canEditUser($_POST['user_id'])) {
	returnWithResponse(FALSE, 0, "Invalid Permissions");
}

if (!validateRequired($_POST['first_name']) || 
	!validateRequired($_POST['middle_name']) || 
	!validateRequired($_POST['last_name'])) {
		
	returnWithResponse(FALSE, 0, "Full Name is Required");
}
if (!validateRequired($_POST['ssn'])) {
	returnWithResponse(FALSE, 0, "SSN is Required");
}
if (!validateRequired($_POST['address'])) {
	returnWithResponse(FALSE, 0, "Address is Required");
}
if (!validateRequired($_POST['email'])) {
	returnWithResponse(FALSE, 0, "Email is Required");
}
if (!validateEmail($_POST['email'])) {
	returnWithResponse(FALSE, 0, "Invalid Email Address");
}
if (!validateRequired($_POST['phone_number'])) {
	returnWithResponse(FALSE, 0, "Contact Number is Required");
}
if (!validatePhone($_POST['phone_number'])) {
	returnWithResponse(FALSE, 0, "Invalid Contact Number");
}
if (!validateRequired($_POST['emergency_first_name']) || 
	!validateRequired($_POST['emergency_middle_name']) || 
	!validateRequired($_POST['emergency_last_name'])) {
		
	returnWithResponse(FALSE, 0, "Full Emergency Contact Name is Required");
}
if (!validateRequired($_POST['emergency_address'])) {
	returnWithResponse(FALSE, 0, "Emergency Contact Address is Required");
}
if (!validateRequired($_POST['emergency_email'])) {
	returnWithResponse(FALSE, 0, "Emergency Contact Email is Required");
}
if (!validateEmail($_POST['emergency_email'])) {
	returnWithResponse(FALSE, 0, "Invalid Emergency Contact Email Address");
}
if (!validateRequired($_POST['emergency_phone_number'])) {
	returnWithResponse(FALSE, 0, "Emergency Contact Number is Required");
}
if (!validatePhone($_POST['emergency_phone_number'])) {
	returnWithResponse(FALSE, 0, "Invalid Emergency Contact Number");
}
if ($_SESSION['account']['access'] == $_SEC_LEVEL['ADMIN']) {
	if (!validateRequired($_POST['group'])) {
		returnWithResponse(FALSE, 0, "Group Name is Required");
	}
	if (!validateRequired($_POST['position_name'])) {
		returnWithResponse(FALSE, 0, "Position Name is Required");
	}
	if (!validateRequired($_POST['position_description'])) {
		returnWithResponse(FALSE, 0, "Position Description is Required");
	}
}

$personnel = find_personnel_by_user_id($_POST['user_id']);

$contact = find_contact_by_id($personnel['personal_contact_number']);

$emergency_contact = find_contact_by_id($personnel['emergency_contact_number']);

$job = find_job_by_id($personnel['job_number']);

$group = find_group_by_id($personnel['group_number']);

$new_contact = array_merge(
	$contact, 
	[
		'first_name' => $_POST['first_name'], 
		'middle_name' => $_POST['middle_name'], 
		'last_name' => $_POST['last_name'], 
		'phone_number' => $_POST['phone_number'], 
		'address' => $_POST['address'], 
		'email' => $_POST['email'], 
	]
);
update_contact($new_contact);

$new_emergency_contact = array_merge(
	$emergency_contact, 
	[
		'first_name' => $_POST['emergency_first_name'], 
		'middle_name' => $_POST['emergency_middle_name'], 
		'last_name' => $_POST['emergency_last_name'], 
		'phone_number' => $_POST['emergency_phone_number'], 
		'address' => $_POST['emergency_address'], 
		'email' => $_POST['emergency_email'], 
	]
);
update_contact($new_emergency_contact);

$new_personnel = array_merge(
	$personnel, 
	[
		'ssn' => $_POST['ssn']
	]
);
update_personnel($new_personnel);

if ($_SESSION['account']['access'] == $_SEC_LEVEL['ADMIN']) {
	$new_job = array_merge(
		$job, 
		[
			'position_name' => $_POST['position_name'], 
			'position_description' => $_POST['position_description']
		]
	);
	update_job($new_job);
}

returnWithResponse(TRUE, 0, "Record has been updated");

/*********************************************************************************************************/

function validateRequired($value) {
	if ($value == NULL) {
		return false;
	}
	if (trim($value) == "") {
		return false;
	}
	return true;
}

function validateEmail($value) {
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

	if (!preg_match($pattern, $value) === 1) {
		return false;
	}
	return true;
}

function validatePhone( $str, $international = false ) {
    $str = trim( $str );
    $str = preg_replace( '/\s+(#|x|ext(ension)?)\.?:?\s*(\d+)/', ' ext \3', $str );

    $us_number = preg_match( '/^(\+\s*)?((0{0,2}1{1,3}[^\d]+)?\(?\s*([2-9][0-9]{2})\s*[^\d]?\s*([2-9][0-9]{2})\s*[^\d]?\s*([\d]{4})){1}(\s*([[:alpha:]#][^\d]*\d.*))?$/', $str, $matches );

    if ( $us_number ) {
        return $matches[4] . '-' . $matches[5] . '-' . $matches[6] . ( !empty( $matches[8] ) ? ' ' . $matches[8] : '' );
    }

    if ( ! $international ) {
        /* SET ERROR: The field must be a valid U.S. phone number (e.g. 888-888-8888) */
        return false;
    }

    $valid_number = preg_match( '/^(\+\s*)?(?=([.,\s()-]*\d){8})([\d(][\d.,\s()-]*)([[:alpha:]#][^\d]*\d.*)?$/', $str, $matches ) && preg_match( '/\d{2}/', $str );

    if ( $valid_number ) {
        return trim( $matches[1] ) . trim( $matches[3] ) . ( !empty( $matches[4] ) ? ' ' . $matches[4] : '' );
    }

    /* SET ERROR: The field must be a valid phone number (e.g. 888-888-8888) */
    return false;
}
?>