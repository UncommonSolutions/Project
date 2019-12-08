<?php SESSION_START(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Uncommon Solutions Personel Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="layout/fontawesome-4.6.3.min.css" rel="stylesheet" type="text/css" media="all">

<link href="layout/viewUserData.css" rel="stylesheet" type="text/css" media="all">

<link href="libs/alert/alert.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="libs/alert/alert.js"></script>
</head>
<?php
include("./includes/header.php");

if (!isLoggedIn() || !canViewUserDetails($_GET['userId'])) {
	redirectToHome();
}
?>

<script type="text/javascript">
	$(document).ready(function() {
		var $_GET = <?php echo json_encode($_GET); ?>;
		
		$("[iedit-on]").hide();
		
		$(document.body).on("click", "#start_edit", function(e) {
			var target = $(e.target);
			
			enable_edit(editFields);
			
			$("#edit_container").empty();
			$("#edit_container").append(
				$("<span />", {
					text: "[ Save ]",
					id: "save_edit",
					class: "link"
				})
			);
			$("#edit_container").append(
				$("<span />", {
					text: "[ Cancel ]",
					id: "cancel_edit",
					class: "link"
				})
			);
		});
		
		$(document.body).on("click", "#cancel_edit", function(e) {
			var target = $(e.target);
			
			cancel_edit(editFields);
			
			$("#edit_container").empty();
			$("#edit_container").append(
				$("<span />", {
					text: "[ Edit ]",
					id: "start_edit",
					class: "link"
				})
			);
		});
		
		$(document.body).on("click", "#save_edit", function(e) {
			var target = $(e.target);
			
			save_edit(
				editFields, 
				{
					user_id: <?php echo $_GET['userId']; ?>
				}
			);
		});
		
		
		
		
		
		$(document.body).on("click", "#new_training", function(e) {
			var target = $(e.target);
			
			document.getElementById('new_training_row').insertAdjacentHTML('beforebegin', 
				"<div class='training table row new_row'>" + 
					"<span class='training_date'><input type='date' name='training_date' id='new_training_date' /></span>" + 
					"<span class='training_info'><input type='text' name='training_content' id='new_training_content' /></span>" + 
					"<span class='training_cancel link'><i class='fa fa-times'></i></span>" +
					"<span class='training_add link'><i class='fa fa-check'></i></span>" +
				"</div>"
			);
		});
		
		$(document.body).on("click", ".training_cancel", function(e) {
			var target = $(e.target);
			
			target.closest(".new_row").remove();
		});
		
		$(document.body).on("click", ".training_add", function(e) {
			var target = $(e.target);
			
			var args = {
				"training_date": target.closest(".new_row").find("#new_training_date").val(), 
				"training_content": target.closest(".new_row").find("#new_training_content").val(), 
				"user_id": $_GET['userId']
			};
			
			$.ajax({                                      
				url: 'assist/createTraining.php',   //the script to call to get data     
				type: 'POST', 
				data: args,       
												//for example "id=5&parent=6"
				dataType: 'json',                //data format      
				success: function(data)          //on recieve of reply
				{
					console.log(data); // spacing level = 2
					if (data.success) {
						target.closest(".new_row")[0].insertAdjacentHTML('beforebegin', 
							"<div class='training table row'>" +
								"<span class='training_date'>" + target.closest(".new_row").find("#new_training_date").val() + "</span>" +
								"<span class='training_info'>" + target.closest(".new_row").find("#new_training_content").val() + "</span>" +
							"</div>"
						);
						target.closest(".new_row").remove();
					} else {
						document.getElementById('content').insertAdjacentHTML('beforebegin', createAlert("error", data.message, ""));
					}
				}, 
				error: function(xhr, textStatus, errorThrown){
					document.getElementById('content').insertAdjacentHTML('beforebegin', createAlert("error", "The record could not be updated", ""));
					console.log(errorThrown);
					console.log(textStatus);
				}
			});
		});
		
		;( function( $, window, document, undefined )
		{
			$( '.inputfile' ).each( function()
			{
				var $input	 = $( this ),
					$label	 = $input.next( 'label' ),
					labelVal = $label.html();

				$input.on( 'change', function( e )
				{
					var fileName = '';

					if( this.files && this.files.length > 1 )
						fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
					else if( e.target.value )
						fileName = e.target.value.split( '\\' ).pop();

					if( fileName )
						$label.html( fileName );
					else
						$label.html( labelVal );
				});

				// Firefox bug fix
				$input
				.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
				.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
			});
		})( jQuery, window, document );
	});
	
	function enable_edit(fields) {
		$.each(fields, function(i, e) {
			var off_element = $("[iedit-off='" + e + "']");
			var on_element = $("[iedit-on='" + e + "']");
			
			
			on_element.val(off_element.text());
			
			if (off_element.is("p")) {
				on_element.width(off_element.width());
				on_element.height(off_element.height());
			}
			
			on_element.show();
			off_element.hide();
		});
	}
	
	function cancel_edit(fields) {
		$.each(fields, function(i, e) {
			var off_element = $("[iedit-off='" + e + "']");
			var on_element = $("[iedit-on='" + e + "']");
			
			
			on_element.text(off_element.val());
			
			on_element.hide();
			off_element.show();
		});
	}
	
	function save_edit(fields, customFields) {
		var args = {};
		$.each(fields, function(i, e) {
			var on_element = $("[iedit-on='" + e + "']");
			args[e] = on_element.val();
		});
		console.log(args);
		args = {...args, ...customFields};
		console.log(args);
		
		$.ajax({                                      
			url: 'assist/editUserData.php',   //the script to call to get data     
			type: 'POST', 
			data: args,       
											//for example "id=5&parent=6"
			dataType: 'json',                //data format      
			success: function(data)          //on recieve of reply
			{
				console.log(data); // spacing level = 2
				if (data.success) {
					document.getElementById('content').insertAdjacentHTML('beforebegin', createAlert("info", data.message, ""));
					
					$.each(fields, function(i, e) {
						var off_element = $("[iedit-off='" + e + "']");
						var on_element = $("[iedit-on='" + e + "']");
						
						
						off_element.text(on_element.val());
						
						on_element.hide();
						off_element.show();
						
						$("#edit_container").empty();
						$("#edit_container").append(
							$("<span />", {
								text: "[ Edit ]",
								id: "start_edit",
								class: "link"
							})
						);
					});
				} else {
					document.getElementById('content').insertAdjacentHTML('beforebegin', createAlert("error", data.message, ""));
					
					//cancel_edit(fields);
				}
			}, 
			error: function(xhr, textStatus, errorThrown){
				document.getElementById('content').insertAdjacentHTML('beforebegin', createAlert("error", "The record could not be updated", ""));
				console.log(errorThrown);
				console.log(textStatus);
			}
		});
	}
	<?php if ($_SESSION['account']['access'] == $_SEC_LEVEL['ADMIN']) { ?>
		var editFields = [
			"first_name", 
			"middle_name", 
			"last_name", 
			"ssn", 
			"address", 
			"email", 
			"phone_number", 
			"emergency_first_name", 
			"emergency_middle_name", 
			"emergency_last_name",  
			"emergency_address", 
			"emergency_email", 
			"emergency_phone_number", 
			"group", 
			"position_name", 
			"position_description"
		];
	<?php } else { ?>
		var editFields = [
			"first_name", 
			"middle_name", 
			"last_name", 
			"ssn", 
			"address", 
			"email", 
			"phone_number", 
			"emergency_first_name", 
			"emergency_middle_name", 
			"emergency_last_name",  
			"emergency_address", 
			"emergency_email", 
			"emergency_phone_number"
		];
	<?php } ?>
</script>

<?php
require_once("./private/initialize.php");
include("./libs/alert/alert.php");

$personnel = find_personnel_by_user_id($_GET['userId']);

$contact = find_contact_by_id($personnel['personal_contact_number']);
$name = $contact['first_name'] . " " . $contact['middle_name'] . " " . $contact['last_name'];

$emergency_contact = find_contact_by_id($personnel['emergency_contact_number']);

$job = find_job_by_id($personnel['job_number']);

$group = find_group_by_id($personnel['group_number']);

$training = find_all_training_records_by_user($personnel['employee_number']);

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
		<h2>
			Record for <?php echo $name; ?>
			<?php if (canEditUser($_GET['userId'])) { ?>
			<div id="edit_container">
				<span class="link" id="start_edit">[ Edit ]</a>
			</div>
			<?php } ?>
		</h2>
		<div>
			<div class="two_third">
				<div class="one_half">
					<label class="title">Name</label>
					<label iedit-off="first_name"><?php echo $contact['first_name']; ?></label>
					<label iedit-off="middle_name"><?php echo $contact['middle_name']; ?></label>
					<label iedit-off="last_name"><?php echo $contact['last_name']; ?></label>
					<input name="first_name" iedit-on="first_name" type="text" />
					<input name="middle_name" iedit-on="middle_name" type="text" />
					<input name="last_name" iedit-on="last_name" type="text" />
					
					<label class="title">SSN</label>
					<label iedit-off="ssn"><?php echo $personnel['ssn']; ?></label>
					<input name="ssn" iedit-on="ssn" type="text" />
					
					<label class="title">Address</label>
					<label iedit-off="address"><?php echo $contact['address']; ?></label>
					<input name="address" iedit-on="address" type="text" />
					
					<label class="title">Email</label>
					<label iedit-off="email"><?php echo $contact['email']; ?></label>
					<input name="email" iedit-on="email" type="text" />
					
					<label class="title">Contact Number</label>
					<label iedit-off="phone_number"><?php echo $contact['phone_number']; ?></label>
					<input name="phone_number" iedit-on="phone_number" type="text" />
				</div>
				<div class="one_half right">
					<label class="title">Emergency Contact Name</label>
					<label iedit-off="emergency_first_name"><?php echo $emergency_contact['first_name']; ?></label>
					<label iedit-off="emergency_middle_name"><?php echo $emergency_contact['middle_name']; ?></label>
					<label iedit-off="emergency_last_name"><?php echo $emergency_contact['last_name']; ?></label>
					<input name="emergency_first_name" iedit-on="emergency_first_name" type="text" />
					<input name="emergency_middle_name" iedit-on="emergency_middle_name" type="text" />
					<input name="emergency_last_name" iedit-on="emergency_last_name" type="text" />
					
					<label class="title">Emergency Contact Address</label>
					<label iedit-off="emergency_address"><?php echo $emergency_contact['address']; ?></label>
					<input name="emergency_address" iedit-on="emergency_address" type="text" />
					
					<label class="title">Emergency Contact Email</label>
					<label iedit-off="emergency_email"><?php echo $emergency_contact['email']; ?></label>
					<input name="emergency_email" iedit-on="emergency_email" type="text" />
					
					<label class="title">Emergency Contact Number</label>
					<label iedit-off="emergency_phone_number"><?php echo $emergency_contact['phone_number']; ?></label>
					<input name="emergency_phone_number" iedit-on="emergency_phone_number" type="text" />
				</div>
			</div>
			<div class="one_third right">
				<label class="title">Group Name</label>
				<label iedit-off="group"><?php echo $group['group_name']; ?></label>
				<input name="group" iedit-on="group" type="text" />
			
				<label class="title">Position Name</label>
				<label iedit-off="position_name"><?php echo $job['position_name']; ?></label>
				<input name="position_name" iedit-on="position_name" type="text" />
				
				<label class="title">Position Description</label>
				<p iedit-off="position_description"><?php echo $job['position_description']; ?></p>
				<textarea name="position_description" iedit-on="position_description"></textarea>
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
				<?php foreach($training as $record) { ?>
				<div class="training table row">
					<span class="training_date"><?php echo $record['record_date']; ?></span>
					<span class="training_info"><?php echo $record['record_content']; ?></span>
				</div>
				<?php } ?>
				<div class="training table row" id="new_training_row">
					<span class="link" id="new_training"><i class="fa fa-plus"></i> Add New Training</span>
				</div>
			</div>
			<div class="one_third right">
				<form action="assist/createResume.php?userId=<?php echo $_GET['userId']; ?>" method="post" enctype="multipart/form-data">
					<label class="title">Resume</label>
					<div class="center">
						<div>
							<a href="assist/downloadresume.php?userId=<?php echo $_GET['userId']; ?>" class="button" id="view_resume">View Most Recent File</a>
						</div>
						<?php if (canEditUser($_GET['userId'])) { ?>
						<div>
							<input id="resume_file" class="inputfile" name="resume_content" type="file" />
							<label for="resume_file"><i class="fa fa-upload" style="margin-right:10px;"></i>Choose a new file</label>
						</div>
						<div>
							<input type="submit" id="resume_file_submit" value="Add New Resume" />
						</div>
						<?php } ?>
					</div>
				</form>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div></div>
<?php
include("./includes/footer.php");
?>
</html>