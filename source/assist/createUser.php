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
	
	if ($_SESSION['account']['access'] == $_SEC_LEVEL['SYS_ADMIN']) {
		$returnTarget = "../viewSysUserList.php";
	} else {
		$returnTarget = "../viewUserList.php";
	}
	?>
	<form id="return" action="<?php echo $returnTarget; ?>" method="post">
		<input type="hidden" name="status" value="<?php echo htmlentities(serialize($response)); ?>">
		<input type="hidden" name="create_return" value="TRUE">
	</form>

	<script type="text/javascript">
		document.getElementById('return').submit();
	</script>
	<?php
}

function returnWithResponse($s, $e, $m) {
	setResponse($s, $e, $m);
	returnCurrentResponse();
}

/*********************************************************************************************************/

if (!canCreateUser()) {
	redirect("../viewSysUserList.php");
}

if (isset($_POST['new_user'])) {
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	if (!validateRequired($firstname) || 
		!validateRequired($middlename)|| 
		!validateRequired($lastname)) {
			
		returnWithResponse(FALSE, 200, "No name was supplied for the user.");
	}
	
	$password = $_POST['password1'];
	$password2 = $_POST['password2'];
	
	if (!validateSame($password, $password2)) {
		returnWithResponse(FALSE, 200, "The passwords did not match.");
	}
	if (!validateRequired($password)) {
		returnWithResponse(FALSE, 200, "No password was supplied for the user.");
	}
	
	$accessLevel = $_POST['level'];
	if (!validateRequired($accessLevel)) {
		returnWithResponse(FALSE, 200, "No account type was supplied for the user.");
	}
	if (!in_array($accessLevel, $_SEC_LEVEL)) {
		returnWithResponse(FALSE, 200, "Invalid account type.");
	}
	if ($_SESSION['account']['access'] != $_SEC_LEVEL['SYS_ADMIN'] && $accessLevel == $_SEC_LEVEL['SYS_ADMIN']) {
		returnWithResponse(FALSE, 200, "Invalid permissions.");
	}
	
	$baseUsername = strtolower(substr($firstname, 0, 1) . substr($middlename, 0, 1) . $lastname);
	$username = $baseUsername;
	
	$usernameSuffix = 2;
	while ($user = find_user_by_username($username) != NULL) {
		$username = $baseUsername . $usernameSuffix;
		$usernameSuffix++;
	}
		
	$passHash = password_hash($password, PASSWORD_DEFAULT);
	
	$user = [
		'user_number' => NULL, 
		'user_name' => $username, 
		'access_level' => $accessLevel,
		'password_hash' => $passHash,
		'last_login' => NULL
	];
	$personnel = [
		'first_name' => $firstname, 
		'middle_name' => $middlename, 
		'last_name' => $lastname
	];
	
	$result = create_all_user_entries($user, $personnel);
	
	if ($result === TRUE) {
		returnWithResponse(TRUE, 100, "The user '$username' has been created");
	} else {
		returnWithResponse(TRUE, 300, "The user failed to be saved to the database");
	}
}

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

function validateSame($value1, $value2) {
	return $value1 == $value2;
}
?>