<style>
    label:hover {
        text-decoration: underline;
    }

    .profile_img {
        border: 0;
        clip: rect(1px, 1px, 1px, 1px);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }

    .img-block {
        align-items: center;
        display: flex;
        flex-direction: column;
    }

    .form-select-cate {
        width: 100%;
        padding: .775rem 3rem .775rem 1rem;
        font-size: 1.1rem;
        font-weight: 500;
        line-height: 1.5;
        color: #4B5675;
        background-color: var(--bs-body-bg);
        appearance: none;
        border: 1px solid #DBDFE9;
        border-radius: .475rem;
        box-shadow: false;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
<div class="pcoded-content bg-white mt-4 px-4">
    <h1 class="pt-4 fw-bold" style="font-weight: bold; padding: 0 30px; font-size: 30px;">Add Product</h1>
    <div class="container main-form mt-4">
        <?php
            use app\core\Application;

            if (Application::$app->session->getFlash('fail')) {
            ?>
                <div class="alert alert_error"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                    <span style="font-weight: bold; font-size: 16px;">Fail!</span>
                    <span style="font-weight: bold; font-size: 16px;"><?php echo Application::$app->session->getFlash('fail') ?></span>
                </div>
            <?php
            }
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
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="/admin-product">List Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="/admin-addproduct">Product Form</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body img-block text-center">
                                <div style="width: 150px; height: 150px; border: 3px solid #ffffff; box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);" class="">
                                    <img id="imagePreview" src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/blank-image.svg" alt="avatar" class="img-fluid" style="max-width: 150px; height: 100% ;border-radius: .475rem; background-repeat: no-repeat; background-size: cover;">
                                </div>
                                <div class="pt-4">
                                    <input name="product_image" onchange="previewImage()" id="imageInput" type="file" id="apply" accept="image/*,.pdf">Photo
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body d-flex flex-column text-start">
                                <h3 style="font-weight: bold;">Thể Loại</h3>
                                <select name="category_category_id" style="width: 100%; padding:0.5rem 1rem; border-radius: 6px;" class="form-select-cate form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true">
                                    <option selected>Choose category</option>
                                    <?php
                                    foreach ($result as $key => $value) {
                                        extract($value);
                                    ?>
                                        <option value="<?php echo $category_id ?>"><?php echo $name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body d-flex flex-column text-start">
                                <h3 style="font-weight: bold;">Status</h3>
                                <select name="status" style="width: 100%; padding:0.5rem 1rem; border-radius: 6px;" class="form-select-cate form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true">
                                    <option selected value="active">active</option>
                                    <option value="inactive">inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php echo $form->field($model, 'product_name') ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php echo $form->field($model, 'price') ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php echo $form->field($model, 'description') ?>
                                    </div>
                                </div>
                                <hr>

                            </div>
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-body d-flex flex-column text-start">
                                <h3 style="font-weight: bold;">Gender</h3>
                                <select name="gender" style="width: 100%; padding:0.5rem 1rem; border-radius: 6px;" class="form-select-cate form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true">
                                    <option selected value="men">Nam</option>
                                    <option value="women">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div style="float: inline-end;">
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $form = \app\core\form\Form::end() ?>
    </div>


</div>