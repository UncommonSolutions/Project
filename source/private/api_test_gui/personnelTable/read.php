<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$personnel = find_personnel_by_id($id);

?>
<a class="" href="<?php echo url_for('private/api_test_gui/personnelTable/index.php'); ?>">&laquo; Back to List</a>


<h1>personnel</h1>
<div>
    <dl>
        <dt>employee number</dt>
        <dd><?php echo h($personnel['employee_number']); ?></dd>
    </dl>
    <dl>
        <dt>user numbere</dt>
        <dd><?php echo h($personnel['user_number']); ?></dd>
    </dl>
    <dl>
        <dt>ssn</dt>
        <dd><?php echo h($personnel['ssn']); ?></dd>
    </dl>
    <dl>
        <dt>personal contact number</dt>
        <dd><?php echo h($personnel['personal_contact_number']); ?></dd>
    </dl>
    <dl>
        <dt>emergency contact number</dt>
        <dd><?php echo h($personnel['emergency_contact_number']); ?></dd>
    </dl>
    <dl>
        <dt>job number</dt>
        <dd><?php echo h($personnel['job_number']); ?></dd>
    </dl>
    <dl>
        <dt>group number</dt>
        <dd><?php echo h($personnel['group_number']); ?></dd>
    </dl>

</div>