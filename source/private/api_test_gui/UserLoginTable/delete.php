<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('private/api_test_gui/UserLoginTable/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {
    $result = delete_user($id);
    redirect_to(url_for('private/api_test_gui/UserLoginTable/index.php'));
} else {

    $user = find_user_by_id($id);
}

?>



<div id="content">

    <a class="back-link" href="<?php echo url_for('/private/api_test_gui/UserLoginTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete User</h1>
        <p>Are you sure you want to delete this User?</p>
        <p class="item"><?php echo htmlspecialchars($user['user_name']); ?></p>

        <form action="<?php echo url_for('/private/api_test_gui/UserLoginTable/delete.php?id=' .
            h(u($user['user_id']))); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete User" />
            </div>
        </form>
    </div>

</div>

