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

$testData = array(
	array(
		'id' => 1,
		'name' => 'Walter Harriman', 
		'job' => 'Head of Research and Development', 
		'email' => 'email@domain.com'
	), 
	array(
		'id' => 2,
		'name' => 'Liam O\'Brien', 
		'job' => 'Chief Financial Officer', 
		'email' => 'email@otherdomain.net'
	)
);
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
		foreach($testData as $user) {
			?>
			<div class="user table row">
				<span class="user_name"><?php echo $user['name']; ?></span>
				<span class="user_job"><?php echo $user['job']; ?></span>
				<span class="user_email"><?php echo $user['email']; ?></span>
				<span class="user_view right"><a href="viewUserData.php?userId=<?php echo $user['id']; ?>">View</a></span>
			</div>
			<?php
		}
		?>
	</div>
</div></div>
<?php
include("./includes/footer.php");
?>
</html>