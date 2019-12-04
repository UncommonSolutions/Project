<?php
require_once('../../../private/initialize.php');

$personnelRecord_set = find_all_personnelRecords();

?>
<h1>personnel Records</h1>

<div class="actions">
    <a class="action" href="<?php echo url_for('/private/api_test_gui/personnelRecordTable/create.php'); ?>">Add personnelRecord</a>
</div>

<table>
    <th>Record Number</th>
    <th>Record Date</th>
    <th>Event Record</th>
    <th>Employee number</th>

    <?php foreach($personnelRecord_set as $personnelRecord) {?>
        <tr>
            <td><?php  echo h(u($personnelRecord['record_number'])); ?></td>
            <td><?php  echo h(u($personnelRecord['record_date'])); ?></td>
            <td><?php  echo h($personnelRecord['event_record']); ?></td>
            <td><?php  echo h(u($personnelRecord['employee_number'])); ?></td>

            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/personnelRecordTable/read.php?id=' . h(u($personnelRecord['record_number']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/personnelRecordTable/edit.php?id=' . h(u($personnelRecord['record_number']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/personnelRecordTable/delete.php?id=' . h(u($personnelRecord['record_number']))); ?>">Delete</a></td>
        </tr>
    <?php } ?>

</table>

