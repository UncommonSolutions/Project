<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('private/api_test_gui/personnelRecordTable/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {
    $result = delete_personnelRecord($id);
    redirect_to(url_for('private/api_test_gui/personnelRecordTable/index.php'));
} else {

    $personnelRecord = find_personnelRecord_by_id($id);
}

?>



<div id="content">

    <a class="back-link" href="<?php echo url_for('/private/api_test_gui/personnelRecordTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete personnelRecord</h1>
        <p>Are you sure you want to delete this personnel Record?</p>

        <form action="<?php echo url_for('/private/api_test_gui/personnelRecordTable/delete.php?id=' .
            h(u($personnelRecord['record_number']))); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete personnelRecord" />
            </div>
        </form>
    </div>

</div>

