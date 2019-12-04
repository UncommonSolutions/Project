<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$trainingRecord = find_trainingRecord_by_id($id);

?>
<a class="" href="<?php echo url_for('private/api_test_gui/trainingRecordTable/index.php'); ?>">&laquo; Back to List</a>


<h1>trainingRecord</h1>
<div>
    <dl>
        <dt>trainingRecord number</dt>
        <dd><?php echo h($trainingRecord['record_number']); ?></dd>
    </dl>
    <dl>
        <dt>trainingRecord date</dt>
        <dd><?php echo h($trainingRecord['record_date']); ?></dd>
    </dl>
    <dl>
        <dt>trainingRecord content</dt>
        <dd><?php echo h($trainingRecord['record_content']); ?></dd>
    </dl>
    <dl>
        <dt>employee number</dt>
        <dd><?php echo h($trainingRecord['employee_number']); ?></dd>
    </dl>


</div>