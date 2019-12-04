<?php
require_once('../../../private/initialize.php');
if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    // save record using post parameters
    $resume['resume_number'] = $id ?? '';
    $resume['resume_date'] = $_POST['resume_date'] ?? '';
    $resume['resume_content'] = $_POST['resume_content'] ?? '';
    $resume['employee_number'] = $_POST['employee_number'] ?? '';

    $result = update_resume($resume);


    if($result === true) {
        redirect_to(url_for('private/api_test_gui/resumeTable/read.php?id=' . $id));
    } else {
        echo "There are errors";
    }
} else {
    $resume = find_resume_by_id($id);
}

?>

<div id="content">

    <a class="" href="<?php echo url_for('private/api_test_gui/resumeTable/index.php'); ?>">&laquo; Back to List</a>

    <div class="">
        <h1>Edit resume</h1>


        <form action="<?php echo url_for('private/api_test_gui/resumeTable/edit.php?id=' . h(u($id))); ?>" method="post">

            <dl>
                <dt>resume number</dt>
                <dd><?php echo h($resume['resume_number']); ?></dd>
            </dl>

            <dl>
                <dt>resume date</dt>
                <dd><input type="text" name="resume_date" value="<?php echo h(u($resume['resume_date'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>resume content</dt>
                <dd><input type="text" name="resume_content" value="<?php echo h(u($resume['resume_content'])); ?>" /></dd>
            </dl>

            <dl>
                <dt>employee number</dt>
                <dd><input type="text" name="employee_number" value="<?php echo h(u($resume['employee_number'])); ?>" /></dd>
            </dl>


            <div>
                <input type="submit" value="Edit resume" />
            </div>
        </form>

    </div>

</div>

