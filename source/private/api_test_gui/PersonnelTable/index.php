<?php
require_once('../../../private/initialize.php');

$personnel_set = find_all_personnel();

?>
<h1>personnel</h1>

<div class="actions">
    <a class="action" href="<?php echo url_for('/private/api_test_gui/personnelTable/create.php'); ?>">Add personnel</a>
</div>

<table>
    <th>Employee Number</th>
    <th>user number</th>
    <th>ssn</th>
    <th>p contact number</th>
    <th>e contact number</th>
    <th>job number</th>
    <th>group number</th>
    <?php foreach($personnel_set as $personnel) {?>
        <tr>
            <td><?php  echo h(u($personnel['employee_number'])); ?></td>
            <td><?php  echo h(u($personnel['user_number'])); ?></td>
            <td><?php  echo h(u($personnel['ssn'])); ?></td>
            <td><?php  echo h(u($personnel['personal_contact_number'])); ?></td>
            <td><?php  echo h(u($personnel['emergency_contact_number'])); ?></td>
            <td><?php  echo $personnel['job_number']; ?></td>
            <td><?php  echo $personnel['group_number']; ?></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/personnelTable/read.php?id=' . h(u($personnel['employee_number']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/personnelTable/edit.php?id=' . h(u($personnel['employee_number']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/personnelTable/delete.php?id=' . h(u($personnel['employee_number']))); ?>">Delete</a></td>
        </tr>
    <?php } ?>

</table>

