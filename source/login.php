<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/login.css" rel="stylesheet" type="text/css" media="all">
</head>
<?php
include("./includes/header.php");
?>

<div id="content" class="wrapper row2"><div>
	<h1>Login</h1>
	<div class="center_outer"><div class="center_inner">
		<form id="login_form" action="#" method="POST">
			<label>Username</label>
			<input type="text" />
			
			<label>Password</label>
			<input type="password" />
			
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