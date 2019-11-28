<?php
require_once('../../../private/initialize.php');

$username = '';
$password = '';

if(is_post_request()) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $user = find_user_by_username($username);
    $success = 0;

    if($user) {
        if (password_verify($password,  $user['password_hash'])) {
            $success = 1;
            set_last_login($user['user_id']);
            create_access_log($user, $success);
            redirect_to(url_for('private/api_test_gui/UserLoginTable/index.php'));
        } else {
            create_access_log($user, $success);
            echo "wrong password!";
        }
    } else {
        echo "wrong username!";
        $user['user_name'] = 'invalid';
        $user['user_id'] = 0;
        create_access_log($user, $success);
    }
}
?>

<div id="content">
    <h1>Log in</h1>


    <form action="login.php" method="post">
        Username:<br />
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" /><br />
        Password:<br />
        <input type="text" name="password" value="" /><br />
        <input type="submit" name="submit" value="Submit"  />
    </form>

</div>
