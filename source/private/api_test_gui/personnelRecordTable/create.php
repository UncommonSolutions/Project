<?php
require_once('../../../private/initialize.php');

$personnelRecord = [
    'record_date' => '',
    'event_record' => '',
    'employee_number' => ''
];

if (is_post_request()) {

    $personnelRecord['record_date'] = $_POST['record_date'];
    $personnelRecord['event_record'] = $_POST['event_record'];
    $personnelRecord['employee_number'] = $_POST['employee_number'];

    $result = create_personnelRecord($personnelRecord);


    if ($result === true) {
        // Inserts auto incremented id into database
        $new_id = mysqli_insert_id($database);
        redirect_to(url_for('private/api_test_gui/personnelRecordTable/read.php?id=' . $new_id));
    } else {
        // show errors
    }

}

?>

<div>

    <a href="<?php echo url_for('private/api_test_gui/personnelRecordTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Create personnelRecord</h1>

        <form action="<?php echo url_for('/private/api_test_gui/personnelRecordTable/create.php'); ?>" method="post">

            <dl>
                <dt>record date</dt>
                <dd><input type="text" name="record_date" value="<?php echo h($personnelRecord['record_date']); ?>"/></dd>
            </dl>

            <dl>
                <dt>event record</dt>
                <dd><input type="text" name="event_record" value="<?php echo h($personnelRecord['event_record']); ?>"/></dd>
            </dl>

            <dl>
                <dt>employee number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h($personnelRecord['employee_number']); ?>"/></dd>
            </dl>


            <div>
                <input type="submit" value="Create personnelRecord"/>
            </div>
        </form>

    </div>

</div>


