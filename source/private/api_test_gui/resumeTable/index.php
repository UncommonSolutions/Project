<?php
require_once('../../../private/initialize.php');

$resume_set = find_all_resumes();

?>
<h1>resume</h1>

<div class="actions">
    <a class="action" href="<?php echo url_for('/private/api_test_gui/resumeTable/create.php'); ?>">Add resume</a>
</div>

<table>
    <th>resume Number</th>
    <th>resume date</th>
    <th>resume content</th>
    <th>employee number</th>

    <?php foreach($resume_set as $resume) {?>
        <tr>
            <td><?php  echo h(u($resume['resume_number'])); ?></td>
            <td><?php  echo h(u($resume['resume_date'])); ?></td>
            <td><?php  echo h(u($resume['resume_content'])); ?></td>
            <td><?php  echo h(u($resume['employee_number'])); ?></td>

            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/resumeTable/read.php?id=' . h(u($resume['resume_number']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/resumeTable/edit.php?id=' . h(u($resume['resume_number']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/resumeTable/delete.php?id=' . h(u($resume['resume_number']))); ?>">Delete</a></td>
        </tr>
    <?php } ?>

</table>

