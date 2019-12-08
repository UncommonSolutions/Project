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
	?>
	<form id="return" action="../login.php" method="post">
		<input type="hidden" name="status" value="<?php echo htmlentities(serialize($response)); ?>">
		<input type="hidden" name="login_return" value="TRUE">
	</form>

	<script type="text/javascript">
		document.getElementById('return').submit();
	</script>
	<?php
	exit();
}

function returnWithResponse($s, $e, $m) {
	setResponse($s, $e, $m);
	returnCurrentResponse();
}

/*********************************************************************************************************/

$user = find_user_by_username($_POST['username']);

if ($user == NULL) {
	returnWithResponse(FALSE, 200, "Invalid Credentials");
} else {
	$USER_ID = $user['user_number'];
	$USER_ACCESS = $user['access_level'];
	
	if (!password_verify($_POST['password'], $user['password_hash'])) {
		create_access_log($USER_ID, FALSE);
		returnWithResponse(FALSE, 200, "Invalid Credentials");
	}
}

$personnel = find_personnel_by_user_id($USER_ID);

$contact = find_contact_by_id($personnel['personal_contact_number']);
$name = $contact['first_name'] . " " . $contact['middle_name'] . " " . $contact['last_name'];

$_SESSION['account'] = [];
$_SESSION['account']['id'] = $USER_ID;
$_SESSION['account']['access'] = $USER_ACCESS;
$_SESSION['account']['data']['name'] = $name;

create_access_log($USER_ID, TRUE);
set_last_login($USER_ID);

switch ($USER_ACCESS) {
	case $_SEC_LEVEL['PRIVILEGED']:
	case $_SEC_LEVEL['ADMIN']:
		redirect("/../viewUserList.php");
		break;
	case $_SEC_LEVEL['SYS_ADMIN']:
		redirect("/../viewSysUserList.php");
		break;
	case $_SEC_LEVEL['USER']:
	default:
		redirect("/../viewUserData.php?userId=$USER_ID");
		break;
}
?>