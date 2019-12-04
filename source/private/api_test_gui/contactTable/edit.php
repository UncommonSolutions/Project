<?php
require_once('../../../private/initialize.php');
if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    // save record using post parameters
    $contact['contact_number'] = $id ?? '';
    $contact['last_name'] = $_POST['last_name'] ?? '';
    $contact['first_name'] = $_POST['first_name'] ?? '';
    $contact['middle_name'] = $_POST['middle_name'] ?? '';
    $contact['phone_number'] = $_POST['phone_number'] ?? '';
    $contact['address'] = $_POST['address'] ?? '';
    $contact['email'] = $_POST['email'] ?? '';

    $result = update_contact($contact);


    if($result === true) {
        redirect_to(url_for('private/api_test_gui/contactTable/read.php?id=' . $id));
    } else {
        echo "There are errors";
    }
} else {
    $contact = find_contact_by_id($id);
}

?>

<div id="content">

    <a class="" href="<?php echo url_for('private/api_test_gui/contactTable/index.php'); ?>">&laquo; Back to List</a>

    <div class="">
        <h1>Edit contact</h1>


        <form action="<?php echo url_for('private/api_test_gui/contactTable/edit.php?id=' . h(u($id))); ?>" method="post">

            <dl>
                <dt>contact number</dt>
                <dd><input type="text" name="contact_number" value="<?php echo h(u($contact['contact_number'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>last name</dt>
                <dd><input type="text" name="last_name" value="<?php echo h(u($contact['last_name'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>first name</dt>
                <dd><input type="text" name="first_name" value="<?php echo h(u($contact['first_name'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>middle name</dt>
                <dd><input type="text" name="middle_name" value="<?php echo h(u($contact['middle_name'])); ?>" /></dd>
            </dl>
            <dl>
                <dt>phone number</dt>
                <dd><input type="text" name="phone_number" value="<?php echo h(u($contact['phone_number'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>address</dt>
                <dd><input type="text" name="address" value="<?php echo $contact['address']; ?>" /></dd>
            </dl>

            <dl>
                <dt>email</dt>
                <dd><input type="text" name="email" value="<?php echo h($contact['email']); ?>" /></dd>
            </dl>

            <div>
                <input type="submit" value="Edit contact" />
            </div>
        </form>

    </div>

</div>

