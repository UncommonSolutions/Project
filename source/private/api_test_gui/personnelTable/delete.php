<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('private/api_test_gui/personnelTable/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {
    $result = delete_personnel($id);
    redirect_to(url_for('private/api_test_gui/personnelTable/index.php'));
} else {

    $personnel = find_personnel_by_id($id);
}

?>



<div id="content">

    <a class="back-link" href="<?php echo url_for('/private/api_test_gui/personnelTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete personnel</h1>
        <p>Are you sure you want to delete this personnel?</p>

        <form action="<?php echo url_for('/private/api_test_gui/personnelTable/delete.php?id=' .
            h(u($personnel['employee_number']))); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete personnel" />
            </div>
        </form>
    </div>

</div>

