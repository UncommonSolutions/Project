<?php
require_once('../../../private/initialize.php');
echo '<h1>userLoginTable<h1/>';

$user_set = find_all_users();

?>
<h1>System users</h1>

<div class="actions">
    <a class="action" href="<?php echo url_for('/private/api_test_gui/userLoginTable/create.php'); ?>">Add User</a>
</div>

<table>
    <th>User ID</th>
    <th>Username</th>
    <th>Access Level</th>
    <th>Last login</th>
    <?php foreach($user_set as $user) {?>
    <tr>
        <td><?php  echo htmlspecialchars(ucfirst($user['user_id'])); ?></td>
        <td><?php  echo htmlspecialchars(ucfirst($user['user_name'])); ?></td>
        <td><?php  echo htmlspecialchars(ucfirst($user['access_level'])); ?></td>
        <td><?php  echo htmlspecialchars(ucfirst($user['last_login'])); ?></td>
        <td><a class="action" href="<?php echo url_for('/private/api_test_gui/userLoginTable/read.php?id=' . h(u($user['user_id']))); ?>">View</a></td>
        <td><a class="action" href="<?php echo url_for('/private/api_test_gui/userLoginTable/edit.php?id=' . h(u($user['user_id']))); ?>">Edit</a></td>
        <td><a class="action" href="<?php echo url_for('/private/api_test_gui/userLoginTable/delete.php?id=' . h(u($user['user_id']))); ?>">Delete</a></td>
    </tr>
    <?php } ?>

</table>

