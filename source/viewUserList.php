<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="layout/fontawesome-4.6.3.min.css" rel="stylesheet" type="text/css" media="all">

<link href="layout/viewUserList.css" rel="stylesheet" type="text/css" media="all">

<link href="libs/popup/popup.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="libs/popup/popup.js"></script>
<link href="libs/alert/alert.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="libs/alert/alert.js"></script>
</head>
<?php
include("./includes/header.php");
include("./libs/alert/alert.php");
require_once("./private/initialize.php");

if (isset($_POST['create_return'])) { 
	$status = unserialize($_POST['status']);
	if ($status['success']) {
		$type = "info";
	} else {
		$type = "error";
	}
	createAlert($type, $status['message'], "");
}
?>

<div id="content" class="wrapper row2"><div>
	<div class="container">
		<h2>Personnel List</h2>
		<div class="user table header">
			<span class="user_name">Name</span>
			<span class="user_job">Position</span>
			<span class="user_email">Email</span>
		</div>
		<?php
		foreach(find_all_users() as $user) {
			if ($user['access_level'] == $_SEC_LEVEL['SYS_ADMIN']) {
				continue;
			}
			$personnel = find_personnel_by_user_id($user['user_number']);
			$contact = find_contact_by_id($personnel['personal_contact_number']);
			$name = $contact['first_name'] . " " . $contact['middle_name'] . " " . $contact['last_name'];
			
			$job = find_job_by_id($personnel['job_number']);
			?>
			<div class="user table row">
				<span class="user_name"><?php echo $name; ?></span>
				<span class="user_job"><?php echo $job['position_name']; ?></span>
				<span class="user_email"><?php echo $contact['email']; ?></span>
				<span class="user_view right"><a href="viewUserData.php?userId=<?php echo $user['user_number']; ?>">View</a></span>
			</div>
			<?php
		}
		if (canCreateUser()) {
		?>
		<div class="user table row">
			<span class="popup_link link" data-popup-id="new_user"><i class="fa fa-plus"></i> Create New User</span>
		</div>
		<?php } ?>
	</div>
</div></div>

<span class="popups">
	<div class="popup_overlay"></div>
	
	<div class="popup_panel" id="popup_new_user" data-popup-id="new_user">
		<div class="popup_close main">
			<i class="fa fa-times"></i>
		</div>
		<div class="popup_header">
			Create New User
		</div>
		
		<span class="payment-errors"></span>
		
		<form action="assist/createUser.php" method="POST" id="new_user_form">
			<div id="user_form" class="main">
				<label>First Name</label>
				<input type="text" name="firstname" />
				
				<label>Middle Name</label>
				<input type="text" name="middlename" />
				
				<label>Last Name</label>
				<input type="text" name="lastname" />
				
				<label>Password</label>
				<input type="password" name="password1" />
				
				<label>Retype Password</label>
				<input type="password" name="password2" />
				
				<label>Access Level</label>
				<select name="level">
					<option value=<?php echo $_SEC_LEVEL['USER']; ?>>Basic User</option>
					<option value=<?php echo $_SEC_LEVEL['PRIVILEGED']; ?>>Privileged User</option>
					<option value=<?php echo $_SEC_LEVEL['ADMIN']; ?>>Records Admin</option>
				</select>
				
			</div>
			<div align="center" class="popup_buttons">
				<input type="submit" value="Create User" />
			</div>
			<input type="hidden" name="new_user" value="TRUE" />
		</form>
	</div>
</span>
<?php
include("./includes/footer.php");
?>
</html>