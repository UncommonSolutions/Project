<?php
SESSION_START();
require("../includes/security.php");

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
	<form id="return" action="../viewSysUserList.php" method="post">
		<input type="hidden" name="status" value="<?php echo htmlentities(serialize($response)); ?>">
		<input type="hidden" name="delete_return" value="TRUE">
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

if (!canDeleteUser()) {
	redirect("../viewSysUserList.php");
}

if (isset($_POST['delete_user'])) {
	$id = $_POST['user_id'];
	
	$username = "FETCH USERNAME";
	
	//if id doesn't exist:
		//returnWithResponse(FALSE, 200, "The specified user could not be found");
	
	returnWithResponse(TRUE, 100, "The user '$username' has been deleted");
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