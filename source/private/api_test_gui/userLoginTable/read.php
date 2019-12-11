<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$user = find_user_by_id($id);

?>
<a class="" href="<?php echo url_for('private/api_test_gui/userLoginTable/index.php'); ?>">&laquo; Back to List</a>


<h1>Member: <?php echo h($user['user_name']); ?></h1>
<div>
    <dl>
        <dt>User Id</dt>
        <dd><?php echo h($user['user_id']); ?></dd>
    </dl>
    <dl>
        <dt>Username</dt>
        <dd><?php echo h($user['user_name']); ?></dd>
    </dl>
    <dl>
        <dt>Access Level</dt>
        <dd><?php echo h($user['access_level']); ?></dd>
    </dl>
    <dl>
        <dt>Password</dt>
        <dd><?php echo h($user['password_hash']); ?></dd>
    </dl>
    <dl>
        <dt>Last Login</dt>
        <dd><?php echo h($user['last_login']); ?></dd>
    </dl>

</div>