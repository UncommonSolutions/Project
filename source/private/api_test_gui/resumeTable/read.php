<?php
require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$resume = find_resume_by_id($id);

?>
<a class="" href="<?php echo url_for('private/api_test_gui/resumeTable/index.php'); ?>">&laquo; Back to List</a>


<h1>resume</h1>
<div>
    <dl>
        <dt>resume number</dt>
        <dd><?php echo h($resume['resume_number']); ?></dd>
    </dl>
    <dl>
        <dt>resume date</dt>
        <dd><?php echo h($resume['resume_date']); ?></dd>
    </dl>
    <dl>
        <dt>resume content</dt>
        <dd><?php echo h($resume['resume_content']); ?></dd>
    </dl>
    <dl>
        <dt>employee number</dt>
        <dd><?php echo h($resume['employee_number']); ?></dd>
    </dl>


</div>