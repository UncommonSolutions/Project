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

if (!isLoggedIn() || !canEditUserTraining($_POST['user_id'])) {
	returnWithResponse(FALSE, 0, "Invalid Permissions");
}

if (!validateRequired($_POST['training_date'])) {
	returnWithResponse(FALSE, 0, "Training Date is Required");
}
if (!validateRequired($_POST['training_content'])) {
	returnWithResponse(FALSE, 0, "Training Description is Required");
}

$personnel = find_personnel_by_user_id($_POST['user_id']);

create_trainingRecord(
	[
		'record_date' => $_POST['training_date'], 
		'record_content' => $_POST['training_content'], 
		'employee_number' => $personnel['employee_number']
	]
);

returnWithResponse(TRUE, 0, "Training Record Has Been Added");

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
?>