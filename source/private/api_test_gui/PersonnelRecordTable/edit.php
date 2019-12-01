<?php
require_once('../../../private/initialize.php');
if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    // save record using post parameters
    $personnelRecord['record_number'] = $id ?? '';
    $personnelRecord['record_date'] = $_POST['record_date'] ?? '';
    $personnelRecord['event_record'] = $_POST['event_record'] ?? '';
    $personnelRecord['employee_number'] = $_POST['employee_number'] ?? '';


    $result = update_personnelRecord($personnelRecord);


    if($result === true) {
        redirect_to(url_for('private/api_test_gui/personnelRecordTable/read.php?id=' . $id));
    } else {
        echo "There are errors";
    }
} else {
    $personnelRecord = find_personnelRecord_by_id($id);
}

?>

<div id="content">

    <a class="" href="<?php echo url_for('private/api_test_gui/personnelRecordTable/index.php'); ?>">&laquo; Back to List</a>

    <div class="">
        <h1>Edit personnelRecord</h1>


        <form action="<?php echo url_for('private/api_test_gui/personnelRecordTable/edit.php?id=' . h(u($id))); ?>" method="post">

            <dl>
                <dt>record date</dt>
                <dd><input type="text" name="record_date" value="<?php echo h(u($personnelRecord['record_date'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>Event Record</dt>
                <dd><input type="text" name="event_record" value="<?php echo h($personnelRecord['event_record']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Employee Number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h(u($personnelRecord['employee_number'])); ?>" /></dd>
            </dl>

            <div>
                <input type="submit" value="Edit personnelRecord" />
            </div>
        </form>

    </div>

</div>

