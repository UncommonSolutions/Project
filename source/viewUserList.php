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
require_once("./private/initialize.php");
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
		?>
	</div>
</div></div>
<?php
include("./includes/footer.php");
?>
</html>