<?php
require_once('../../../private/initialize.php');
if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    // save record using post parameters
    $personnel['employee_number'] = $id ?? '';
    $personnel['user_number'] = $_POST['user_number'] ?? '';
    $personnel['ssn'] = $_POST['ssn'] ?? '';
    $personnel['personal_contact_number'] = $_POST['personal_contact_number'] ?? '';
    $personnel['emergency_contact_number'] = $_POST['emergency_contact_number'] ?? '';
    $personnel['job_number'] = $_POST['job_number'] ?? '';
    $personnel['group_number'] = $_POST['group_number'] ?? '';

    $result = update_personnel($personnel);


    if($result === true) {
        redirect_to(url_for('private/api_test_gui/personnelTable/read.php?id=' . $id));
    } else {
        echo "There are errors";
    }
} else {
    $personnel = find_personnel_by_id($id);
}

?>

<div id="content">

    <a class="" href="<?php echo url_for('private/api_test_gui/personnelTable/index.php'); ?>">&laquo; Back to List</a>

    <div class="">
        <h1>Edit personnel</h1>


        <form action="<?php echo url_for('private/api_test_gui/personnelTable/edit.php?id=' . h(u($id))); ?>" method="post">

            <dl>
                <dt>personnel number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h(u($personnel['employee_number'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>last name</dt>
                <dd><input type="text" name="user_number" value="<?php echo h(u($personnel['user_number'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>first name</dt>
                <dd><input type="text" name="ssn" value="<?php echo h(u($personnel['ssn'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>middle name</dt>
                <dd><input type="text" name="personal_contact_number" value="<?php echo h(u($personnel['personal_contact_number'])); ?>" /></dd>
            </dl>
            <dl>
                <dt>phone number</dt>
                <dd><input type="text" name="emergency_contact_number" value="<?php echo h(u($personnel['emergency_contact_number'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>address</dt>
                <dd><input type="text" name="job_number" value="<?php echo $personnel['job_number']; ?>" /></dd>
            </dl>

            <dl>
                <dt>email</dt>
                <dd><input type="text" name="group_number" value="<?php echo h($personnel['group_number']); ?>" /></dd>
            </dl>

            <div>
                <input type="submit" value="Edit personnel" />
            </div>
        </form>

    </div>

</div>

