<?php
require_once('../../../private/initialize.php');

$trainingRecord = [
    'record_date' => '',
    'record_content' => '',
    'employee_number' => ''

];

if (is_post_request()) {

    $trainingRecord['record_date'] = $_POST['record_date'];
    $trainingRecord['record_content'] = $_POST['record_content'];
    $trainingRecord['employee_number'] = $_POST['employee_number'];


    $result = create_trainingRecord($trainingRecord);

    if ($result === true) {
        // Inserts auto incremented id into database
        $new_id = mysqli_insert_id($database);
        redirect_to(url_for('private/api_test_gui/trainingRecordTable/read.php?id=' . $new_id));
    } else {
        // show errors
    }

}

?>

<div>

    <a href="<?php echo url_for('private/api_test_gui/trainingRecordTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Create trainingRecord</h1>

        <form action="<?php echo url_for('/private/api_test_gui/trainingRecordTable/create.php'); ?>" method="post">

            <dl>
                <dt>trainingRecord date</dt>
                <dd><input type="text" name="record_date" value="<?php echo h($trainingRecord['record_date']); ?>"/></dd>
            </dl>

            <dl>
                <dt>trainingRecord content</dt>
                <dd><input type="text" name="record_content" value="<?php echo h($trainingRecord['record_content']); ?>"/></dd>
            </dl>

            <dl>
                <dt>Employee Number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h($trainingRecord['employee_number']); ?>"/></dd>
            </dl>


            <div>
                <input type="submit" value="Create trainingRecord"/>
            </div>
        </form>

    </div>

</div>


