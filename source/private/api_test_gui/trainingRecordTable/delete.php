<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('private/api_test_gui/trainingRecordTable/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {
    $result = delete_trainingRecord($id);
    redirect_to(url_for('private/api_test_gui/trainingRecordTable/index.php'));
} else {

    $trainingRecord = find_trainingRecord_by_id($id);
}

?>



<div id="content">

    <a class="back-link" href="<?php echo url_for('/private/api_test_gui/trainingRecordTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete trainingRecord</h1>
        <p>Are you sure you want to delete this trainingRecord?</p>

        <form action="<?php echo url_for('/private/api_test_gui/trainingRecordTable/delete.php?id=' .
            h(u($trainingRecord['record_number']))); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete trainingRecord" />
            </div>
        </form>
    </div>

</div>

