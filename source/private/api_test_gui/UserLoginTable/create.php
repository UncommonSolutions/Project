<?php
require_once('../../../private/initialize.php');

$user = [
    'user_id' => '',
    'user_name' => '',
    'access_level' => '',
    'password_hash' => '',
    'last_login' => ''
];

if (is_post_request()) {

    $user['user_id'] = $_POST['user_id'];
    $user['user_name'] = $_POST['user_name'];
    $user['access_level'] = $_POST['access_level'];
    $user['password_hash'] = $_POST['password_hash'];
    $user['last_login'] = $_POST['last_login'];

    $result = create_user($user);


    if ($result === true) {

        redirect_to(url_for('private/api_test_gui/UserLoginTable/show.php?id=' . $user['user_id']));
    } else {
        // show errors
    }

}

?>

<div>

    <a href="<?php echo url_for('private/api_test_gui/UserLoginTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Create User</h1>

        <form action="<?php echo url_for('/private/api_test_gui/UserLoginTable/create.php'); ?>" method="post">

            <dl>
                <dt>User Id</dt>
                <dd><input type="text" name="user_id" value="<?php echo h($user['user_id']); ?>"/></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="user_name" value="<?php echo h($user['user_name']); ?>"/></dd>
            </dl>

            <dl>
                <dt>Access Level</dt>
                <dd><input type="text" name="access_level" value="<?php echo h($user['access_level']); ?>"/></dd>
            </dl>

            <dl>
                <dt>Password Hash</dt>
                <dd><input type="text" name="password_hash" value="<?php echo h($user['password_hash']); ?>"/></dd>
            </dl>

            <dl>
                <dt>Last login</dt>
                <dd><input type="text" name="last_login" value="<?php echo h($user['last_login']); ?>"/></dd>
            </dl>

            <div>
                <input type="submit" value="Create User"/>
            </div>
        </form>

    </div>

</div>


