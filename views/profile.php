<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img src="<?php echo $infor->avatar === '' ? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp' : $infor->avatar  ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                                Edit profile
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <?php

                                        use app\core\Application;

                                        $form = \app\core\form\Form::begin('', 'post') ?>
                                        <div class="modal-body">
                                            <div class="card mb-4">
                                                <?php echo $form->fieldUpdate($model, 'email', $infor) ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <?php echo $form->fieldUpdate($model, 'firstname', $infor) ?>
                                                    </div>
                                                    <div class="col">
                                                        <?php echo $form->fieldUpdate($model, 'lastname', $infor) ?>
                                                    </div>
                                                </div>
                                                <div class="card-body img-block text-center">
                                                    <div style="width: 150px; height: 150px; border: 3px solid #ffffff; box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);" class="">
                                                        <img id="imagePreview" src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/blank-image.svg" alt="avatar" class="img-fluid" style="max-width: 150px; height: 100% ;border-radius: .475rem; background-repeat: no-repeat; background-size: cover;">
                                                    </div>
                                                    <div class="pt-4">
                                                        <input name="avatar" onchange="previewImage()" id="imageInput" type="file" id="apply" accept="image/*,.pdf">Photo
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        <?php $form = \app\core\form\Form::end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                            <h5><?php echo Application::$app->userExists->getUserName() ?></h5>
                            <p>Son Tay</p>
                        </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                        <div class="d-flex justify-content-end text-center py-1">
                            <div>
                                <p class="mb-1 h5">253</p>
                                <p class="small text-muted mb-0">Photos</p>
                            </div>
                            <div class="px-3">
                                <p class="mb-1 h5">1026</p>
                                <p class="small text-muted mb-0">Followers</p>
                            </div>
                            <div>
                                <p class="mb-1 h5">478</p>
                                <p class="small text-muted mb-0">Following</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="mb-5">
                            <p class="lead fw-normal mb-1">About</p>
                            <div class="p-4" style="background-color: #f8f9fa;">
                                <p class="font-italic mb-1">Web Developer</p>
                                <p class="font-italic mb-1">Lives in New York</p>
                                <p class="font-italic mb-0">Photographer</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0">Recent photos</p>
                            <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp" alt="image 1" class="w-100 rounded-3">
                            </div>
                            <div class="col mb-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp" alt="image 1" class="w-100 rounded-3">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp" alt="image 1" class="w-100 rounded-3">
                            </div>
                            <div class="col">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp" alt="image 1" class="w-100 rounded-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>