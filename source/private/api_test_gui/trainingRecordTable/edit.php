<?php
require_once('../../../private/initialize.php');
if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    // save record using post parameters
    $trainingRecord['record_number'] = $id ?? '';
    $trainingRecord['record_date'] = $_POST['record_date'] ?? '';
    $trainingRecord['record_content'] = $_POST['record_content'] ?? '';
    $trainingRecord['employee_number'] = $_POST['employee_number'] ?? '';

    $result = update_trainingRecord($trainingRecord);


    if($result === true) {
        redirect_to(url_for('private/api_test_gui/trainingRecordTable/read.php?id=' . $id));
    } else {
        echo "There are errors";
    }
} else {
    $trainingRecord = find_trainingRecord_by_id($id);
}

?>

<div id="content">

    <a class="" href="<?php echo url_for('private/api_test_gui/trainingRecordTable/index.php'); ?>">&laquo; Back to List</a>

    <div class="">
        <h1>Edit trainingRecord</h1>


        <form action="<?php echo url_for('private/api_test_gui/trainingRecordTable/edit.php?id=' . h(u($id))); ?>" method="post">

            <dl>
                <dt>trainingRecord number</dt>
                <dd><?php echo h($trainingRecord['record_number']); ?></dd>
            </dl>

            <dl>
                <dt>trainingRecord date</dt>
                <dd><input type="text" name="record_date" value="<?php echo h(u($trainingRecord['record_date'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>trainingRecord content</dt>
                <dd><input type="text" name="record_content" value="<?php echo h(u($trainingRecord['record_content'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>employee number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h(u($trainingRecord['employee_number'])); ?>" /></dd>
            </dl>


            <div>
                <input type="submit" value="Edit trainingRecord" />
            </div>
        </form>

    </div>

</div>

