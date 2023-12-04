<div class="container" style="margin-top: 80px;
    width: 100%;
    text-align: center;
    align-items: center;
    justify-content: center;
    margin-left: 300px;
    display: flex; margin-top: 80px; padding: 0px 100px;">
    <div class="row">
        <div class="col-4 order-md-2 mb-4 ">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Đặt Hàng</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3 ">
                <li style="font-size: 18px;" class="list-group-item d-flex justify-content-between">
                    <span>Tổng phụ(VNĐ): </span>
                    <span><?= $total ?>₫</span>
                </li>
                <li style="font-size: 18px;" class="list-group-item d-flex justify-content-between">
                    <span>Vận chuyển/Shipping</span>
                    <span>Free</span>
                </li>
                <hr>
                <li style="font-size: 18px;" class="list-group-item d-flex justify-content-between">
                    <span>Tổng(VNĐ): </span>
                    <span><?= $total ?>₫</span>
                </li>
            </ul>
            <div class="row">
                <?php
                foreach ($cart as $value) {
                    extract($value);
                ?>
                    <div class="pb-4 mb-2">
                        <div class="card" style="width: 100%; border: none;">
                            <div class="row">
                                <div class="col">
                                    <img src="<?= $product_image ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <div class="product-description mt-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-column align-items-start">
                                                <span style="color: black;" class="fw-4"><?= $product_name ?></span>
                                                <span style="color: #707072; "><?= $description ?></span>
                                                <span style="color: #707072; margin-bottom: 8px;">qty: <?= $quantity ?></span>
                                                <span><?= $price ?>₫</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-6 order-md-1">
            <!-- <h4 class="mb-3">Billing address</h4> -->
            <div style="margin-top: 0; align-items: baseline;" class="main-form checkout-form">
                <div class="mb-4">
                    <h3>Contact Information</h3>
                    <hr>
                </div>
                <?php if (isset($infor)) : ?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php $form = \app\core\form\Form::begin('/checkout-update', 'post') ?>

                                    <?php echo $form->fieldUpdate($model, 'email', $infor) ?>
                                    <?php echo $form->fieldUpdate($model, 'phone', $infor) ?>
                                    <!-- tinh/thanhpho -->
                                    <!-- quan/huyen -->
                                    <!-- phuong/xa -->
                                    <p style="font-size: 18px;" class="d-flex pt-4">Name and Address
                                        <hr>
                                    </p>
                                    <div class="row">
                                        <div class="col">
                                            <?php echo $form->fieldUpdate($model, 'firstname', $infor) ?>
                                        </div>
                                        <div class="col">
                                            <?php echo $form->fieldUpdate($model, 'lastname', $infor) ?>
                                        </div>
                                    </div>
                                    <div class="row py-4">
                                        <div class="col">
                                            <select name="province" class="province select-check">
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="district" class="district select-check">
                                                <option value="">chọn quận</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="ward" class="ward select-check">
                                                <option value="">chọn phường</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php echo $form->fieldUpdate($model, 'address', $infor) ?>

                                    <input style="background-color: #E22A19; color: white;" class="w-100 fw-bold btn mt-4 py-2" type="submit" value="Save Change" />
                                    <?php $form = \app\core\form\Form::end() ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $form = \app\core\form\Form::begin('', 'post') ?>

                    <?php echo $form->fieldUpdate($infor, 'email', $infor) ?>
                    <?php echo $form->fieldUpdate($infor, 'phone', $infor) ?>
                    <!-- tinh/thanhpho -->
                    <!-- quan/huyen -->
                    <!-- phuong/xa -->
                    <p style="font-size: 18px;" class="d-flex pt-4">Name and Address
                        <hr>
                    </p>
                    <div class="rounded border h-100 d-flex flex-column align-items-start" style="padding: 8px 12px; border-color: #b3b3b3;">
                        <span><?php echo $infor->firstname . $infor->lastname . ', ' . $infor->phone ?></span>
                        <span><?php echo $infor->address ?></span>
                        <span class="direct"><?php echo $infor->ward . ', ' . $infor->district . ', ' . $infor->province ?></span>
                        <button type="button" class="edit-modal btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                    </div>

                    <button class="btn btn-primary w-100 mt-4" type="submit">Checkout</button>

                    <?php $form = \app\core\form\Form::end() ?>
                <?php else : ?>
                    <?php $form = \app\core\form\Form::begin('', 'post') ?>

                    <?php echo $form->field($model, 'email') ?>
                    <?php echo $form->field($model, 'phone') ?>
                    <!-- tinh/thanhpho -->
                    <!-- quan/huyen -->
                    <!-- phuong/xa -->
                    <p style="font-size: 18px;" class="d-flex pt-4">Name and Address
                        <hr>
                    </p>
                    <div class="row">
                        <div class="col">
                            <?php echo $form->field($model, 'firstname') ?>
                        </div>
                        <div class="col">
                            <?php echo $form->field($model, 'lastname') ?>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col">
                            <select name="province" class="province select-check">
                            </select>
                        </div>
                        <div class="col">
                            <select name="district" class="district select-check">
                                <option value="">chọn quận</option>
                            </select>
                        </div>
                        <div class="col">
                            <select name="ward" class="ward select-check">
                                <option value="">chọn phường</option>
                            </select>
                        </div>
                    </div>
                    <?php echo $form->field($model, 'address') ?>

                    <input style="background-color: #E22A19; color: white;" class="w-100 fw-bold btn mt-4 py-2" type="submit" value="Continue" />
                    <?php $form = \app\core\form\Form::end() ?>
                <?php endif ?>
                <div>
                </div>
            </div>
        </div>