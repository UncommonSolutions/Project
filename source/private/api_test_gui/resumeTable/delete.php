<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('private/api_test_gui/resumeTable/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {
    $result = delete_resume($id);
    redirect_to(url_for('private/api_test_gui/resumeTable/index.php'));
} else {

    $resume = find_resume_by_id($id);
}

?>



<div id="content">

    <a class="back-link" href="<?php echo url_for('/private/api_test_gui/resumeTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete resume</h1>
        <p>Are you sure you want to delete this resume?</p>

        <form action="<?php echo url_for('/private/api_test_gui/resumeTable/delete.php?id=' .
            h(u($resume['resume_number']))); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete resume" />
            </div>
        </form>
    </div>

</div>

