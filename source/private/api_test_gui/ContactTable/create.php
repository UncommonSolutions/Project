<?php
require_once('../../../private/initialize.php');

$contact = [
    'last_name' => '',
    'first_name' => '',
    'middle_name' => '',
    'phone_number' => '',
    'address' => '',
    'email' => ''
];

if (is_post_request()) {

    $contact['last_name'] = $_POST['last_name'];
    $contact['first_name'] = $_POST['first_name'];
    $contact['middle_name'] = $_POST['middle_name'];
    $contact['phone_number'] = $_POST['phone_number'];
    $contact['address'] = $_POST['address'];
    $contact['email'] = $_POST['email'];

    $result = create_contact($contact);


    if ($result === true) {
        // Inserts auto incremented id into database
        $new_id = mysqli_insert_id($database);
        redirect_to(url_for('private/api_test_gui/contactTable/read.php?id=' . $new_id));
    } else {
        // show errors
    }

}

?>

<div>

    <a href="<?php echo url_for('private/api_test_gui/contactTable/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Create contact</h1>

        <form action="<?php echo url_for('/private/api_test_gui/contactTable/create.php'); ?>" method="post">

            <dl>
                <dt>last name</dt>
                <dd><input type="text" name="last_name" value="<?php echo h($contact['last_name']); ?>"/></dd>
            </dl>

            <dl>
                <dt>first name</dt>
                <dd><input type="text" name="first_name" value="<?php echo h($contact['first_name']); ?>"/></dd>
            </dl>

            <dl>
                <dt>middle name</dt>
                <dd><input type="text" name="middle_name" value="<?php echo h($contact['middle_name']); ?>"/></dd>
            </dl>

            <dl>
                <dt>phone number</dt>
                <dd><input type="text" name="phone_number" value="<?php echo h($contact['phone_number']); ?>"/></dd>
            </dl>

            <dl>
                <dt>address</dt>
                <dd><input type="text" name="address" value="<?php echo h($contact['address']); ?>"/></dd>
            </dl>

            <dl>
                <dt>email</dt>
                <dd><input type="text" name="email" value="<?php echo h($contact['email']); ?>"/></dd>
            </dl>

            <div>
                <input type="submit" value="Create contact"/>
            </div>
        </form>

    </div>

</div>


