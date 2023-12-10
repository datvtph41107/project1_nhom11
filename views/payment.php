<?php
use app\core\Application;

if (Application::$app->session->getFlash('paymentFailed')) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?php echo Application::$app->session->getFlash('paymentFailed') ?>
        </div>
    <?php
}
?>

<div class="main-content">
    <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
    <p class="main-content__body" data-lead-id="main-content-body">Sport gửi lời cảm ơn tới bạn.</p>
    <a href="/">Tiếp tục với trang chủ</a>
</div>