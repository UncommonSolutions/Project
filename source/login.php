<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link href="layout/login.css" rel="stylesheet" type="text/css" media="all">

<link href="libs/alert/alert.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="libs/alert/alert.js"></script>
</head>
<?php
include("./includes/header.php");
include("./libs/alert/alert.php");
?>

<?php
if (isset($_POST['login_return'])) { 
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
	<h1>Login</h1>
	<div class="center_outer"><div class="center_inner">
		<form id="login_form" action="./assist/login.php" method="POST">
			<label>Username</label>
			<input type="text" name="username" />
			
			<label>Password</label>
			<input type="password" name="password" />
			
			<div class="center">
				<input type="submit" value="Login" />
			</div>
		</form>
	</div></div>
	<p class="center">Access of this system constitutes consent to monitoring</p>
</div></div>
<?php
include("./includes/footer.php");
?>
</html>