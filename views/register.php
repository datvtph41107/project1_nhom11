<h1>Register</h1>
<!-- Uncaught Error: Object of class app\core\form\Form could not be converted to string  -->
<!-- Lỗi này là khi truy cập sd 1 đối tượng và dối tượng không thể chuyển đổi sang string qua echo -->
<!-- trong function field chưa trả vè dữ liệu chuỗi nào -->
<?php $form = \app\core\form\Form::begin('', 'post') ?>
<!-- echo ra dữ liệu dạng chuỗi được trả về -->
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

    <input class="btn btn-primary btn-lg mt-4" type="submit" value="Register" />
<?php \app\core\form\Form::end() ?>
<!-- <form action="" method="post">
    <div class="row">
        <div class="col mb-4">
            <div class="form-outline">
                <label class="form-label">First Name</label>
                <input type="text" name="firstname" 
                value="<?php echo $model->firstname ?? '' ?>" 
                class="form-control form-control-lg
                <?php echo $model->hasError('firstname') ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                    <?php echo $model->getFirstError('firstname') ?>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="form-outline">
                <label class="form-label" for="lastName">Last Name</label>
                <input type="text" name="lastname" id="lastName" class="form-control form-control-lg" />
            </div>
        </div>
    </div>

    <div class=" mb-4 pb-2">
        <div class="form-outline">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control form-control-lg" />
        </div>
    </div>
    <div class=" mb-4 pb-2">
        <div class="form-outline">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control form-control-lg" />
        </div>

    </div>

    <div class=" mb-4 pb-2">
        <div class="form-outline">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control form-control-lg" />
        </div>

    </div>
    <div class="mt-4 pt-2">
        <input class="btn btn-primary btn-lg" type="submit" value="Register" />
    </div>

</form> -->