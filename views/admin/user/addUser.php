<div style="padding: 24px 52px;" class="pcoded-content bg-white mt-4">
<h1 class="py-4 fw-bold" style="font-weight: bold; padding: 0 30px; font-size: 30px;">Add Category</h1>
<div style="padding: 0 30px;">
<?php
    use app\core\Application;
    if (Application::$app->session->getFlash('success')) {
        ?>
        <div class="alert alert_success"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
            <span style="font-weight: bold; font-size: 16px;">success!</span> 
            <span style="font-weight: bold; font-size: 16px;"><?php echo Application::$app->session->getFlash('success') ?></span>
        </div>
        <?php
    }
?>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
    <div class="mb-3 row">
        <div class="col">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>
    <div class="mb-3">
        <?php echo $form->field($model, 'email') ?>
    </div>

    <div class="">
        <button type="submit" name="add_category" class="btn btn-outline-primary">
            Thêm mới
        </button>
        <button type="button" class="btn btn-outline-primary mx-2" name="reset_form">Nhập lại</button>
        <a href="/admin-user">
            <button type="button" class="btn btn-outline-primary">
                Danh sách
            </button>
        </a>
    </div>
    <?php $form = \app\core\form\Form::end() ?>
</div>
</div>
  