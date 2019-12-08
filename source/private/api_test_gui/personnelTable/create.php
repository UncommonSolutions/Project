<?php
require_once('../../../private/initialize.php');

$personnel = [
    'user_number' => '',
    'ssn' => '',
    'personal_contact_number' => '',
    'emergency_contact_number' => '',
    'job_number' => '',
    'group_number' => ''
];

if (is_post_request()) {

    $personnel['user_number'] = $_POST['user_number'];
    $personnel['ssn'] = $_POST['ssn'];
    $personnel['personal_contact_number'] = $_POST['personal_contact_number'];
    $personnel['emergency_contact_number'] = $_POST['emergency_contact_number'];
    $personnel['job_number'] = $_POST['job_number'];
    $personnel['group_number'] = $_POST['group_number'];

    $result = create_personnel($personnel);


    if ($result === true) {
        // Inserts auto incremented id into database
        $new_id = mysqli_insert_id($database);
        redirect_to(url_for('private/api_test_gui/personnelTable/read.php?id=' . $new_id));
    } else {
        // show errors
    }

}

?>

<div>

    <a href="<?php echo url_for('private/api_test_gui/personnelTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Create personnel</h1>

        <form action="<?php echo url_for('/private/api_test_gui/personnelTable/create.php'); ?>" method="post">

            <dl>
                <dt>user number</dt>
                <dd><input type="text" name="user_number" value="<?php echo h($personnel['user_number']); ?>"/></dd>
            </dl>

            <dl>
                <dt>ssn</dt>
                <dd><input type="text" name="ssn" value="<?php echo h($personnel['ssn']); ?>"/></dd>
            </dl>

            <dl>
                <dt>personal contact number</dt>
                <dd><input type="text" name="personal_contact_number" value="<?php echo h($personnel['personal_contact_number']); ?>"/></dd>
            </dl>

            <dl>
                <dt>emergency contact number</dt>
                <dd><input type="text" name="emergency_contact_number" value="<?php echo h($personnel['emergency_contact_number']); ?>"/></dd>
            </dl>

            <dl>
                <dt>job number</dt>
                <dd><input type="text" name="job_number" value="<?php echo h($personnel['job_number']); ?>"/></dd>
            </dl>

            <dl>
                <dt>group number</dt>
                <dd><input type="text" name="group_number" value="<?php echo h($personnel['group_number']); ?>"/></dd>
            </dl>

            <div>
                <input type="submit" value="Create personnel"/>
            </div>
        </form>

    </div>

</div>


