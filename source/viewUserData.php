<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/viewUserData.css" rel="stylesheet" type="text/css" media="all">
</head>
<?php
include("./includes/header.php");
?>

<div id="content" class="wrapper row2"><div>
	<div class="container">
		<h2>
			Record for Walter Harriman
			<?php if (canEditUser($_GET['userId'])) { ?>
			<div class="edit">
				<a href="#">[ Edit ]</a>
			</div>
			<?php } ?>
		</h2>
		<div>
			<div class="two_third">
				<div class="one_half">
					<label class="title">Name</label>
					<label>Walter Harriman</label>
					
					<label class="title">SSN</label>
					<label>AAA-GG-SSSS</label>
					
					<label class="title">Address</label>
					<label>9854 Poplar Dr. St. Helena, ND 58310</label>
					
					<label class="title">Email</label>
					<label>email@domain.com</label>
				</div>
				<div class="one_half right">
					<label class="title">Phone Number</label>
					<label>(301)-555-9954</label>
					
					<label class="title">Personal Contact Number</label>
					<label>(301)-555-8432</label>
					
					<label class="title">Emergency Contact Number</label>
					<label>(301)-555-4252</label>
				</div>
			</div>
			<div class="one_third right">
				<label class="title">Group Name</label>
				<label>Group 3</label>
			
				<label class="title">Position Name</label>
				<label>Head of Research and Development</label>
				
				<label class="title">Position Description</label>
				<p>Sed blandit posuere dui in porta. Donec gravida auctor odio nec rutrum. Phasellus vel velit hendrerit, semper tortor ac, scelerisque metus. Nulla id pulvinar leo. Nunc justo velit, aliquet vulputate rhoncus ornare, fermentum vitae sapien. Vestibulum et rutrum lacus, ac sollicitudin mauris. Fusce enim elit, egestas a nunc vitae, egestas pharetra lacus. Pellentesque hendrerit tristique lobortis. Integer finibus lobortis aliquet.</p>
			</div>
			<div class="clear"></div>
		</div>
		<div>
			<div class="two_third">
				<label class="title">Training</label>
				
				<div class="training table header">
					<span class="training_date">Date</span>
					<span class="training_info">Training</span>
				</div>
				<div class="training table row">
					<span class="training_date">2019/08/14</span>
					<span class="training_info">???</span>
				</div>
				<div class="training table row">
					<span class="training_date">2019/08/14</span>
					<span class="training_info">???</span>
				</div>
			</div>
			<div class="one_third right">
				<label class="title">Resume</label>
				<div class="center">
					<a href="#" class="button" id="view_resume">View Most Recent File</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div></div>
<?php
include("./includes/footer.php");
?>
</html>