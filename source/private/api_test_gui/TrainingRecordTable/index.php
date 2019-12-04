<?php
require_once('../../../private/initialize.php');

$trainingRecord_set = find_all_trainingRecords();

?>
<h1>training Record</h1>

<div class="actions">
    <a class="action" href="<?php echo url_for('/private/api_test_gui/trainingRecordTable/create.php'); ?>">Add trainingRecord</a>
</div>

<table>
    <th>Record Number</th>
    <th>Record date</th>
    <th>Record content</th>
    <th>employee number</th>

    <?php foreach($trainingRecord_set as $trainingRecord) {?>
        <tr>
            <td><?php  echo h(u($trainingRecord['record_number'])); ?></td>
            <td><?php  echo h(u($trainingRecord['record_date'])); ?></td>
            <td><?php  echo h($trainingRecord['record_content']); ?></td>
            <td><?php  echo h(u($trainingRecord['employee_number'])); ?></td>

            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/trainingRecordTable/read.php?id=' . h(u($trainingRecord['record_number']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/trainingRecordTable/edit.php?id=' . h(u($trainingRecord['record_number']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/trainingRecordTable/delete.php?id=' . h(u($trainingRecord['record_number']))); ?>">Delete</a></td>
        </tr>
    <?php } ?>

</table>

