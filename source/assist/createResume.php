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
	<form id="return" action="../viewUserData.php?userId=<?php echo $_GET['userId']; ?>" method="post">
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

if (!isLoggedIn() || !canEditUser($_POST['user_id'])) {
	returnWithResponse(FALSE, 0, "Invalid Permissions");
}

$personnel = find_personnel_by_user_id($_GET['userId']);

create_resume(
	[
		'resume_date' => date("Y-m-d"), 
		'resume_content' => file_get_contents($_FILES['resume_content']['tmp_name']), 
		'employee_number' => $personnel['employee_number']
	]
);

returnWithResponse(TRUE, 0, "Resume Has Been Added");

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