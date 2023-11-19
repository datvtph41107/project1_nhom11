<!-- Uncaught Error: Object of class app\core\form\Form could not be converted to string  -->
<!-- Lỗi này là khi truy cập sd 1 đối tượng và dối tượng không thể chuyển đổi sang string qua echo -->
<!-- trong function field chưa trả vè dữ liệu chuỗi nào -->
<!-- echo ra dữ liệu dạng chuỗi được trả về -->
<div class="main-form">
<?php $form = \app\core\form\Form::begin('', 'post') ?>
    <h3 class="heading fw-bold fs-4">Đăng ký</h3>
        <div class="spacer"></div>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordFieldType() ?>
    <?php echo $form->field($model, 'confirmPassword')->passwordFieldType() ?>
        <div class="d-flex justify-content-between mt-4">
            <a class="text-black" href="">Quên mật khẩu</a>
            <a class="text-black" href="/login">Đăng nhập</a>
        </div>
        <input style="background-color: #E22A19; color: white;" class="w-100 fw-bold btn mt-4" type="submit" value="Đăng ký" />
    <?php $form = \app\core\form\Form::end() ?>
    <div>
</div>