<h1>Hi, Admin</h1>
<?php

use app\core\Application;

?>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
    <!-- Email input -->
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordFieldType() ?>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Sign in</button>
  
<?php $form = \app\core\form\Form::end() ?>