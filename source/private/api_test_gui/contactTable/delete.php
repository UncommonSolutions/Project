<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('private/api_test_gui/contactTable/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {
    $result = delete_contact($id);
    redirect_to(url_for('private/api_test_gui/contactTable/index.php'));
} else {

    $contact = find_contact_by_id($id);
}

?>



<div id="content">

    <a class="back-link" href="<?php echo url_for('/private/api_test_gui/contactTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete contact</h1>
        <p>Are you sure you want to delete this contact?</p>

        <form action="<?php echo url_for('/private/api_test_gui/contactTable/delete.php?id=' .
            h(u($contact['contact_number']))); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete contact" />
            </div>
        </form>
    </div>

</div>

