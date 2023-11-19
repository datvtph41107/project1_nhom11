<div class="main-form">
<?php $form = \app\core\form\Form::begin('', 'post') ?>
    <h3 class="heading fw-bold fs-4">Đăng nhập</h3>
        <div class="spacer"></div>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordFieldType() ?>
        <div class="d-flex justify-content-between mt-4">
            <a class="text-black" href="">Quên mật khẩu</a>
            <a class="text-black" href="/register">Đăng ký</a>
        </div>
        <input style="background-color: #E22A19; color: white;" class="w-100 fw-bold btn mt-4" type="submit" value="Login" />
    <?php $form = \app\core\form\Form::end() ?>
    <div>
</div>

