<?php
require_once('../../../private/initialize.php');

$resume = [
    'resume_date' => '',
    'resume_content' => '',
    'employee_number' => ''

];

if (is_post_request()) {

    $resume['resume_date'] = $_POST['resume_date'];
    $resume['resume_content'] = $_POST['resume_content'];
    $resume['employee_number'] = $_POST['employee_number'];


    $result = create_resume($resume);

    if ($result === true) {
        // Inserts auto incremented id into database
        $new_id = mysqli_insert_id($database);
        redirect_to(url_for('private/api_test_gui/resumeTable/read.php?id=' . $new_id));
    } else {
        // show errors
    }

}

?>

<div>

    <a href="<?php echo url_for('private/api_test_gui/resumeTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Create resume</h1>

        <form action="<?php echo url_for('/private/api_test_gui/resumeTable/create.php'); ?>" method="post">

            <dl>
                <dt>resume date</dt>
                <dd><input type="text" name="resume_date" value="<?php echo h($resume['resume_date']); ?>"/></dd>
            </dl>

            <dl>
                <dt>resume content</dt>
                <dd><input type="text" name="resume_content" value="<?php echo h($resume['resume_content']); ?>"/></dd>
            </dl>

            <dl>
                <dt>Employee Number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h($resume['employee_number']); ?>"/></dd>
            </dl>


            <div>
                <input type="submit" value="Create resume"/>
            </div>
        </form>

    </div>

</div>


