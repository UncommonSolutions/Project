<link href="layout/core.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/header.css" rel="stylesheet" type="text/css" media="all">

<?php
require("security.php");

if (isset($_SESSION['account'])) {
	$USERNAME = $_SESSION['account']['data']['name'];
	$USER_LEVEL = $_SEC_LEVEL_NAME[$_SESSION['account']['access']];
}
?>

<body>
	<div id="header">
		<div class="row0 wrapper"><div>
			<img id="logo" src="./images/temp.png" />
			<label id="logoText">Uncommon Solutions Personel Management System</label>
			
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<?php if (canViewUserList()) { ?>
					<li><a href="viewUserList.php">View Users</a></li>
					<?php } ?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
		</div></div>
		<div id="headerUserInfo" class="row1 wrapper"><div>
			<?php 
			if (isset($_SESSION['account'])) { ?>
			<label id="headerUsername">Welcome <?php echo $USERNAME; ?></label>
			<label id="headerAccess">User Access Level: <?php echo $USER_LEVEL; ?></label>
			<?php } ?>
		</div></div>
	</div>
</body>