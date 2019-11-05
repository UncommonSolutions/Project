<?php
require_once('private/database.php');
echo '<h1>Uncommon Solutions<h1/>';

$db = db_connect();

$sql = "SELECT * FROM group_members ORDER BY last_name";

$result = mysqli_query($db, $sql);

confirm_result_set($result);

$group_set = $result;

?>

<table>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <?php foreach($group_set as $member) {?>
    <tr>
        <td><?php  echo htmlspecialchars(ucfirst($member['first_name'])); ?></td>
        <td><?php  echo htmlspecialchars(ucfirst($member['last_name'])); ?></td>
        <td><?php  echo htmlspecialchars(ucfirst($member['email'])); ?></td>
    </tr>
    <?php } ?>

</table>

