<?php
    require_once('../../../private/initialize.php');
    if(!isset($_GET['id'])) {
        redirect_to(url_for('index.php'));
    }
    $id = $_GET['id'];

    if(is_post_request()) {
        // save record using post parameters
       $user['user_id'] = $_POST['user_id'];
       $user['user_name'] = $_POST['user_name'];
       $user['access_level'] = $_POST['access_level'];
       $user['password_hash'] = $_POST['password_hash'];
       $user['last_login'] = $_POST['last_login'];

       $result = update_user($user);


        if($result === true) {
            echo "record updated successfully";
        } else {
            echo "There are errors";
        }
    } else {
        $user = find_user_by_id($id);
    }

    ?>

<div id="content">

    <a class="" href="<?php echo url_for('private/api_test_gui/UserLoginTable/index.php'); ?>">&laquo; Back to List</a>

    <div class="">
        <h1>Edit User</h1>


        <form action="<?php echo url_for('private/api_test_gui/UserLoginTable/edit.php?id=' . h(u($id))); ?>" method="post">

            <dl>
                <dt>User Id</dt>
                <dd><input type="text" name="user_id" value="<?php echo h($user['user_id']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="user_name" value="<?php echo h($user['user_name']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Access Level</dt>
                <dd><input type="text" name="access_level" value="<?php echo h($user['access_level']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><input type="text" name="password_hash" value="<?php echo h($user['password_hash']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Last Login</dt>
                <dd><input type="text" name="last_login" value="<?php echo h($user['last_login']); ?>" /></dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit User" />
            </div>
        </form>

    </div>

</div>

