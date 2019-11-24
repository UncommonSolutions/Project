<link href="layout/core.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/header.css" rel="stylesheet" type="text/css" media="all">

<?php
$USERNAME = "{INSERT USERNAME HERE}";
$USER_LEVEL = "{USER LEVEL}";
?>

<body>
	<div id="header">
		<div class="row0 wrapper"><div>
			<img id="logo" src="./images/temp.png" />
			<label id="logoText">Uncommon Solutions Personel Management System</label>
			
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</nav>
		</div></div>
		<div id="headerUserInfo" class="row1 wrapper"><div>
			<label id="headerUsername">Welcome <?php echo $USERNAME; ?></label>
			<label id="headerAccess">User Access Level: <?php echo $USER_LEVEL; ?></label>
		</div></div>
	</div>
</body>