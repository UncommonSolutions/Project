<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/viewUserList.css" rel="stylesheet" type="text/css" media="all">
</head>
<?php
include("./includes/header.php");
?>

<div id="content" class="wrapper row2"><div>
	<div class="container">
		<h2>Personnel List</h2>
		<div class="user table header">
			<span class="user_name">Name</span>
			<span class="user_job">Position</span>
			<span class="user_email">Email</span>
		</div>
		<div class="user table row">
			<span class="user_name">Walter Harriman</span>
			<span class="user_job">Head of Research and Development</span>
			<span class="user_email">email@domain.com</span>
			<span class="user_delete right"><a href="#">Delete</a></span>
			<span class="user_edit right"><a href="#">Edit</a></span>
		</div>
		<div class="user table row">
			<span class="user_name">Liam O'Brien</span>
			<span class="user_job">Chief Financial Officer</span>
			<span class="user_email">email@otherdomain.net</span>
			<span class="user_delete right"><a href="#">Delete</a></span>
			<span class="user_edit right"><a href="#">Edit</a></span>
		</div>
		<div class="user table row">
			<span><a href="#">+ Create New User</a></span>
		</div>
	</div>
</div></div>
<?php
include("./includes/footer.php");
?>
</html>