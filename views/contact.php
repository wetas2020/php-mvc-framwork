<?php
/** @var $this \app\core\View */

/** @var $model \app\models\ContactForm */

use app\core\form\TextareaField;

$this->title = 'Contact';
?>

<h1>Contact us</h1>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php $form = \app\core\form\Form::end() ?>

<!--<form action="" method="post">-->
<!--    <div class="mb-3">-->
<!--        <label>Subject</label>-->
<!--        <input type="text" class="form-control" name="subject">-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label>Email</label>-->
<!--        <input type="text" class="form-control" name="email">-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label>Body</label>-->
<!--        <textarea class="form-control" name="body"></textarea>-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-primary">Submit</button>-->
<!--</form>-->