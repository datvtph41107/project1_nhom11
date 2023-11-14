<h1>Login</h1>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordFieldType() ?>
    <input class="btn btn-primary btn-lg mt-4" type="submit" value="Login" />
<?php $form = \app\core\form\Form::end() ?>

