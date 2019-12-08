<?php
$_SEC_LEVEL = array(
	'USER' => 0,
	'PRIVILEGED' => 1,
	'ADMIN' => 2,
	'SYS_ADMIN' => 3
);

$_SEC_LEVEL_NAME = array(
	0 => 'User',
	1 => 'Privileged User',
	2 => 'Administrator',
	3 => 'System Administrator'
);

function redirect($targetURL) {
	// Start defining the URL.
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Check for a trailing slash.
	if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
		$url = substr ($url, 0, -1); // Chop off the slash.
	}
	// Add the page.
	$url .= $targetURL;
	
	ob_end_clean(); // Delete the buffer.
	echo '<script type="text/javascript">window.location = "' . $url . '"</script>';
	exit(); // Quit the script.
}

function redirectToHome() {
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['USER']:
			redirect("/viewUserData.php?userId=" . $_SESSION['account']['id']);
			break;
		case $_SEC_LEVEL['PRIVILEGED']:
			redirect("/viewUserList.php");
			break;
		case $_SEC_LEVEL['ADMIN']:
			redirect("/viewUserList.php");
			break;
		case $_SEC_LEVEL['SYS_ADMIN']:
			redirect("/viewSysUserList.php");
			break;
		default:
			redirect("/logout.php");
			break;
	}
}

function canDeleteUser() {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['SYS_ADMIN']:
			return true;
			break;
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['ADMIN']:
		case $_SEC_LEVEL['USER']:
		default:
			return false;
			break;
	}
}

function canEditUser($id) {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['ADMIN']:
			return true;
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['USER']:
			if ($id == $_SESSION['account']['id']) {
				return true;
			}
			return false;
		case $_SEC_LEVEL['SYS_ADMIN']:
		default:
			return false;
	}
}

function canEditUserTraining($id) {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['ADMIN']:
			return true;
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['USER']:
		case $_SEC_LEVEL['SYS_ADMIN']:
		default:
			return false;
	}
}

function canCreateUser() {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['SYS_ADMIN']:
			return true;
			break;
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['ADMIN']:
		case $_SEC_LEVEL['USER']:
		default:
			return false;
			break;
	}
}

function canViewUserDetails($id) {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['ADMIN']:
			return true;
		case $_SEC_LEVEL['USER']:
			if ($id == $_SESSION['account']['id']) {
				return true;
			}
			return false;
		case $_SEC_LEVEL['SYS_ADMIN']:
		default:
			return false;
	}
}

function canViewUserList() {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['ADMIN']:
			return true;
		case $_SEC_LEVEL['USER']:
		case $_SEC_LEVEL['SYS_ADMIN']:
		default:
			return false;
	}
}

function canViewSysUserList() {
	if (!isLoggedIn()) {
		return false;
	}
	global $_SEC_LEVEL;
	switch ($_SESSION['account']['access']) {
		case $_SEC_LEVEL['SYS_ADMIN']:
			return true;
		case $_SEC_LEVEL['USER']:
		case $_SEC_LEVEL['PRIVILEGED']:
		case $_SEC_LEVEL['ADMIN']:
		default:
			return false;
	}
}

function isLoggedIn() {
	return isset($_SESSION['account']);
}
?>