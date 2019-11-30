<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$contact = find_contact_by_id($id);

?>
<a class="" href="<?php echo url_for('private/api_test_gui/contactTable/index.php'); ?>">&laquo; Back to List</a>


<h1>contact</h1>
<div>
    <dl>
        <dt>contact number</dt>
        <dd><?php echo h($contact['contact_number']); ?></dd>
    </dl>
    <dl>
        <dt>last name</dt>
        <dd><?php echo h($contact['last_name']); ?></dd>
    </dl>
    <dl>
        <dt>first name</dt>
        <dd><?php echo h($contact['first_name']); ?></dd>
    </dl>
    <dl>
        <dt>middle name</dt>
        <dd><?php echo h($contact['middle_name']); ?></dd>
    </dl>
    <dl>
        <dt>Phone number</dt>
        <dd><?php echo h($contact['phone_number']); ?></dd>
    </dl>
    <dl>
        <dt>address</dt>
        <dd><?php echo h($contact['address']); ?></dd>
    </dl>
    <dl>
        <dt>email</dt>
        <dd><?php echo h($contact['email']); ?></dd>
    </dl>

</div>