<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="layout/fontawesome-4.6.3.min.css" rel="stylesheet" type="text/css" media="all">

<link href="layout/viewSysUserList.css" rel="stylesheet" type="text/css" media="all">

<link href="libs/popup/popup.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="libs/popup/popup.js"></script>
<link href="libs/alert/alert.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="libs/alert/alert.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$(document.body).on("click", ".user_delete", function(e) {
		var target = $(e.target);
		var id = target.closest(".user_delete").attr('data-user-id');
		
		$("#delete_user_form input[name='user_id']").val(id);
	});
});
</script>

</head>
<?php
include("./includes/header.php");
include("./libs/alert/alert.php");
require_once("./private/initialize.php");

if (isset($_POST['create_return']) || isset($_POST['delete_return'])) { 
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
		<h2>Account List</h2>
		<div class="user table header">
			<span class="user_username">Username</span>
			<span class="user_name">Name</span>
			<span class="user_email">Email</span>
			<span class="user_delete right">Delete</span>
		</div>
		<?php
		
		foreach(find_all_users() as $user) {
			?>
			<div class="user table row">
				<span class="user_username"><?php echo $user['user_name']; ?></span>
				<span class="user_name"><?php //echo $user['name']; ?></span>
				<span class="user_email"><?php //echo $user['email']; ?></span>
				<?php if (canDeleteUser()) { ?>
					<span class="user_delete right popup_link link" data-popup-id="delete_user" data-user-id="<?php echo $user['user_number']; ?>">
						<i class="fa fa-times"></i>
					</span>
				<?php } ?>
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
					<option value=<?php echo $_SEC_LEVEL['SYS_ADMIN']; ?>>System Admin</option>
				</select>
				
			</div>
			<div align="center" class="popup_buttons">
				<input type="submit" value="Create User" />
			</div>
			<input type="hidden" name="new_user" value="TRUE" />
		</form>
	</div>
	
	<div class="popup_panel" id="popup_delete_user" data-popup-id="delete_user">
		<div class="popup_close main">
			<i class="fa fa-times"></i>
		</div>
		<div class="popup_header">
			Delete User
		</div>
		
		<span class="payment-errors"></span>
		
		<form action="assist/deleteUser.php" method="POST" id="delete_user_form">
			<div align="center" class="popup_buttons">
				<input type="submit" value="Delete" />
			</div>
			<input type="hidden" name="delete_user" value="TRUE" />
			<input type="hidden" name="user_id" value=NULL />
		</form>
	</div>
</span>
<?php
include("./includes/footer.php");
?>
</html>