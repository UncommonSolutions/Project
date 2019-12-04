<?php
require_once('../../../private/initialize.php');

$contact_set = find_all_contacts();

?>
<h1>Contact</h1>

<div class="actions">
    <a class="action" href="<?php echo url_for('/private/api_test_gui/ContactTable/create.php'); ?>">Add contact</a>
</div>

<table>
    <th>contact Number</th>
    <th>last name</th>
    <th>first name</th>
    <th>middle name</th>
    <th>phone number</th>
    <th>address</th>
    <th>email</th>
    <?php foreach($contact_set as $contact) {?>
        <tr>
            <td><?php  echo h(u($contact['contact_number'])); ?></td>
            <td><?php  echo h(u($contact['last_name'])); ?></td>
            <td><?php  echo h(u($contact['first_name'])); ?></td>
            <td><?php  echo h(u($contact['middle_name'])); ?></td>
            <td><?php  echo h(u($contact['phone_number'])); ?></td>
            <td><?php  echo $contact['address']; ?></td>
            <td><?php  echo h($contact['email']); ?></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/ContactTable/read.php?id=' . h(u($contact['contact_number']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/ContactTable/edit.php?id=' . h(u($contact['contact_number']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/private/api_test_gui/ContactTable/delete.php?id=' . h(u($contact['contact_number']))); ?>">Delete</a></td>
        </tr>
    <?php } ?>

</table>

