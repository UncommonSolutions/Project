<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$personnelRecord = find_personnelRecord_by_id($id);

?>
<a class="" href="<?php echo url_for('private/api_test_gui/personnelRecordTable/index.php'); ?>">&laquo; Back to List</a>


<h1>personnelRecord</h1>
<div>
    <dl>
        <dt>record number</dt>
        <dd><?php echo h($personnelRecord['record_number']); ?></dd>
    </dl>
    <dl>
        <dt>record date</dt>
        <dd><?php echo h($personnelRecord['record_date']); ?></dd>
    </dl>
    <dl>
        <dt>event record</dt>
        <dd><?php echo h($personnelRecord['event_record']); ?></dd>
    </dl>
    <dl>
        <dt>employee number</dt>
        <dd><?php echo h($personnelRecord['employee_number']); ?></dd>
    </dl>

</div>