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

//if wrong credentials:
	//returnWithResponse(FALSE, 200, "Invalid Login");
	
$USER_ID = 2;
//$USER_ACCESS = $_SEC_LEVEL['USER'];
//$USER_ACCESS = $_SEC_LEVEL['PRIVILEGED'];
//$USER_ACCESS = $_SEC_LEVEL['ADMIN'];
$USER_ACCESS = $_SEC_LEVEL['SYS_ADMIN'];

$_SESSION['account'] = [];
$_SESSION['account']['id'] = $USER_ID;
$_SESSION['account']['access'] = $USER_ACCESS;
$_SESSION['account']['data']['name'] = "John Smith";

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