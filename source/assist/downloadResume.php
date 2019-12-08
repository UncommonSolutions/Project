<?php
SESSION_START();
require("../includes/security.php");
require_once("../private/initialize.php");

if (!isLoggedIn() || !canViewUserDetails($_GET['userId'])) {
	exit;
}

$personnel = find_personnel_by_user_id($_GET['userId']);

$resume = find_latest_resume_by_user($personnel['employee_number']);

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
$new_filename = "resume.bin";

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$new_filename");
echo $resume['resume_content'];
exit;
?>