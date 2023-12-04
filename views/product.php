<!-- <div class="container_product"> -->
<div class="wrapper-center mt-4 pt-4">
    <div class="d-md-flex align-items-md-center">
        <div class="h3"><?php echo ucfirst($_GET['gender'] ?? 'Dres') ?>'s Clothings</div>
        <div class="ml-auto d-flex align-items-center views"> <span class="btn text-success"> <span class="fas fa-th px-md-2 px-1"></span><span>Grid view</span> </span> <span class="btn"> <span class="fas fa-list-ul"></span><span class="px-md-2 px-1">List view</span> </span> <span class="green-label px-md-2 px-1">428</span> <span class="text-muted">Products</span> </div>
    </div>
    <div class="d-lg-flex align-items-lg-center pt-2">
        <div class="form-inline d-flex align-items-center my-2 mr-lg-2 radio bg-light border"> <label class="options">Most Popular <input type="radio" name="radio"> <span class="checkmark"></span> </label> <label class="options">Cheapest <input type="radio" name="radio" checked> <span class="checkmark"></span> </label> </div>
        <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> <label class="tick">Farm <input type="checkbox" checked="checked"> <span class="check"></span> </label> <span class="text-success px-2 count"> 328</span> </div>
        <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> <label class="tick">Bio <input type="checkbox"> <span class="check"></span> </label> <span class="text-success px-2 count"> 72</span> </div>
        <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> <label class="tick">Czech republic <input type="checkbox"> <span class="check"></span> </label> <span class="border px-1 mx-2 mr-3 font-weight-bold count"> 12</span> <select name="country" id="country" class="bg-light">
                <option value="" hidden>Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="Uk">UK</option>
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-3">
            <div class="">
                <h5 class=" fw-bold">Categories</h5>
                <ul class="list-group">
                    <?php
                    foreach ($category as $key => $value) {
                    ?>
                        <li id="<?php echo $value['category_id'] ?>" class="category-filter ms-2 list-group-item list-group-item-action d-flex justify-content-between align-items-center category">
                            <?php echo $value['name'] ?>
                            <span class="badge badge-primary badge-pill">
                                328
                            </span>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="">
                <h5 class=" fw-bold">Genders</h5>
                <ul class="list-group">
                    <?php
                    $genderName = ["men" => "Men", "women" => "Women", "kid" => "Kids"];
                    foreach ($genderName as $key => $gender) {
                        if (!isset($_GET['gender'])) {
                            ?>
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> <?php echo $gender ?> 
                                    <input class="filter-check" type="checkbox" name="" id="<?= $key ?>" value="<?= $key ?>">
                                    <span class="badge badge-primary badge-pill">112</span>
                                </li>
                            <?php
                        }else {
                            ?>
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> <?php echo $gender ?> 
                                <input class="filter-check" type="checkbox" name="" id="<?= $key ?>" value="<?= $key ?>" <?= ($_GET['gender'] === $key) ? 'checked' : '' ?>>
                                    <span class="badge badge-primary badge-pill">112</span>
                                </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="">
                <h5 class=" fw-bold">Shop By Price</h5>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> Clothings <span class="badge badge-primary badge-pill">328</span> </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> Shoes <span class="badge badge-primary badge-pill">112</span> </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> T-shirt <span class="badge badge-primary badge-pill">32</span> </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category"> Pants <span class="badge badge-primary badge-pill">48</span> </li>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="loading-indicator">Loading...</div>
            <div class="row row-cols-4 filter-container">
                <?php
                foreach ($model as $key => $value) {
                ?>
                    <a href="/product-detail?id=<?php echo $value['product_id'] ?>">
                        <div class="col pb-4 mb-2">
                            <div class="card" style="width: 100%; border: none;">
                                <img src="<?php echo $value['product_image'] ?>" class="card-img-top" alt="...">
                                <div class="product-description mt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start">
                                            <h6 style="color: #E22A19;" class="fw-bold">Bản giới hạn</h6>
                                            <h5 style="color: black; margin-bottom: 4px;" class="fw-4"><?php echo $value['product_name'] ?></h5>
                                            <span style="color: #707072; margin-bottom: 8px;"><?php echo $value['description'] ?></span>
                                            <span><?php echo $value['price'] ?>₫</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>
<!-- </div> -->