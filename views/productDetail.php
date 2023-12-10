<style>
    .card-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    img {
        width: 100%;
        display: block;
    }

    .img-display {
        overflow: hidden;
    }

    .img-showcase {
        display: flex;
        width: 100%;
        transition: all 0.5s ease;
    }

    .img-showcase img {
        min-width: 100%;
    }

    .img-select {
        display: flex;
    }

    .img-item {
        margin: 0.3rem;
    }

    .img-item:nth-child(1),
    .img-item:nth-child(2),
    .img-item:nth-child(3) {
        margin-right: 0;
    }

    .img-item:hover {
        opacity: 0.8;
    }

    .product-content {
        padding: 2rem 1rem;
    }

    .product-title {
        font-size: 3rem;
        text-transform: capitalize;
        font-weight: 700;
        position: relative;
        color: #12263a;
        margin: 1rem 0;
    }

    .product-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 80px;
        background: #12263a;
    }

    .product-link {
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 400;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 0.5rem;
        background: #256eff;
        color: #fff;
        padding: 0 0.3rem;
        transition: all 0.5s ease;
    }

    .product-link:hover {
        opacity: 0.9;
    }

    .product-rating {
        color: #ffc107;
    }

    .product-rating span {
        font-weight: 600;
        color: #252525;
    }

    .product-price {
        margin: 1rem 0;
        font-size: 1rem;
        font-weight: 700;
    }

    .product-price span {
        font-weight: 400;
    }

    .last-price span {
        color: #f64749;
        text-decoration: line-through;
    }

    .new-price span {
        color: #256eff;
    }

    .product-detail h2 {
        text-transform: capitalize;
        color: #12263a;
        padding-bottom: 0.6rem;
    }

    .product-detail p {
        font-size: 0.9rem;
        padding: 0.3rem;
        opacity: 0.8;
    }

    .product-detail ul {
        margin: 1rem 0;
        font-size: 0.9rem;
    }

    .product-detail ul li {
        margin: 0;
        list-style: none;
        background: url(shoes_images/checked.png) left center no-repeat;
        background-size: 18px;
        padding-left: 1.7rem;
        margin: 0.4rem 0;
        font-weight: 600;
        opacity: 0.9;
    }

    .product-detail ul li span {
        font-weight: 400;
    }

    .purchase-info {}

    .purchase-info input,
    .purchase-info .btn {
        border: 1.5px solid #ddd;
        border-radius: 25px;
        text-align: center;
        outline: 0;
        margin-right: 0.2rem;
    }

    .purchase-info input {
        padding: 3px 0;
        width: 100px;
    }

    .purchase-info .btn {
        cursor: pointer;
        color: #fff;
    }

    .purchase-info .btn:first-of-type {
        background: #256eff;
    }

    .purchase-info .btn:last-of-type {
        background: #f64749;
    }

    .purchase-info .btn:hover {
        opacity: 0.9;
    }

    .social-links {
        display: flex;
        align-items: center;
    }

    .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        color: #000;
        border: 1px solid #000;
        margin: 0 0.2rem;
        border-radius: 50%;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.5s ease;
    }

    .social-links a:hover {
        background: #000;
        border-color: transparent;
        color: #fff;
    }

    @media screen and (min-width: 992px) {
        .card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }

        .card-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-imgs {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-content {
            padding-top: 0;
        }
    }

    header {
        position: relative;
    }

    #resultDiv {
        display: none;
        z-index: 1000;
    }

    .box-notify {
        display: none;
        background-color: white;
        position: absolute;
        z-index: 1;
        border-radius: 6px;
        padding: 12px 20px;
        margin-right: 30px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        transition: opacity 0.3s ease-in-out;
        /* pointer-events: none; */
    }

    .box-notify.appear {
        display: block;
    }

    .body-notify-img {
        width: 88px;
        height: 88px;
    }

    .body-btn-cart button {
        padding: 10px 24px;
    }

    .btn-notify {
        width: 120px;
        margin-right: 8px;
    }

    .btn-notify:hover {
        color: white !important;
    }
</style>
<?php
?>
<div id="resultDiv" class="d-flex flex-column align-items-end">
    <div class="box-notify" style="position: fixed;">
        <div class="">
            <div class="heading-notify-cart d-flex justify-content-between mb-4">
                <div class="heading-left">
                    <i style="color: green;" class="fa-solid fa-circle-check"></i>
                    Added to Bag
                </div>
                <div style="cursor: pointer;" class="heading-left" onclick="removeNotifyCart()">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <hr>
            <div class="body-notify-card d-flex">
                <div class="body-notify-img">
                    <img class="h-100 w-100" src="<?php echo $model->product_image ?>" alt="">
                </div>
                <div class="body-notify-des d-flex flex-column mx-4" style="width: 280px;">
                    <p class="mb-0"><?php echo $model->product_name ?></p>
                    <span style="color: #707072; margin-bottom: 8px;"><?php echo $model->description ?></span>
                    <span><?php echo $model->price ?>₫</span>
                </div>
            </div>
            <div class="body-btn-cart mt-4 ">
                <a href="/cart">
                    <button style="font-weight: 400;" class="btn-notify btn btn-primary">View bag</button>
                </a>
                <a href="">
                    <button class="btn-notify btn btn-dark">Check out</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card-wrapper" style="margin-top: 55px;">
    <div class="card" style="border: none;">
        <!-- card left -->
        <div class="product-imgs">
            <div class="img-display">
                <div class="img-showcase">
                    <img src="<?php echo $model->product_image ?>" alt="shoe image">
                </div>
            </div>
            <div class="img-select">
                <div class="img-item">
                    <a href="#" data-id="1">
                        <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/63e4fd7a-cb93-413d-86e2-877c8b45e5d5/paris-saint-germain-graphic-t-shirt-H051S1.png" alt="shoe image">
                    </a>
                </div>
                <div class="img-item">
                    <a href="#" data-id="2">
                        <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/63e4fd7a-cb93-413d-86e2-877c8b45e5d5/paris-saint-germain-graphic-t-shirt-H051S1.png" alt="shoe image">
                    </a>
                </div>
                <div class="img-item">
                    <a href="#" data-id="3">
                        <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/63e4fd7a-cb93-413d-86e2-877c8b45e5d5/paris-saint-germain-graphic-t-shirt-H051S1.png" alt="shoe image">
                    </a>
                </div>
                <div class="img-item">
                    <a href="#" data-id="4">
                        <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/63e4fd7a-cb93-413d-86e2-877c8b45e5d5/paris-saint-germain-graphic-t-shirt-H051S1.png" alt="shoe image">
                    </a>
                </div>
            </div>
        </div>
        <!-- card right -->
        <div class="product-content" style="padding-left: 80px;">
            <h2 class="product-title"><?php echo $model->product_name ?></h2>
            <a href="#" class="product-link">visit nike store</a>
            <div class="product-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span>4.7(21)</span>
            </div>

            <div class="product-price">
                <p class="last-price">Old Price: <span>$257.00</span></p>
                <p class="new-price">New Price: <span><?php echo $model->price ?> (5%)</span></p>
            </div>

            <div class="product-detail">
                <h2>about this item: </h2>
                <p><?php echo $model->description ?></p>
                <ul>
                    <li>Color: <span>Black</span></li>
                    <li>Available: <span>in stock</span></li>
                    <li>Category: <span>Shoes</span></li>
                    <li>Shipping Area: <span>All over the world</span></li>
                    <li>Shipping Fee: <span>Free</span></li>
                </ul>
            </div>

            <form action="/product-detail" method="post" class="purchase-info" id="productForm" style="margin: 0; padding: 0; text-align: start; box-shadow: none; margin-top: 50px; ">
                <input name="quantity" type="number" min="0" value="1" id="quantityInput">
                <button type="submit" style="padding: 10px 20px;" class="btn-addtocar btn btn-primary">
                    Add to Cart <i class="fas fa-shopping-cart"></i>
                </button>
            </form>

            <div class="social-links">
                <p>Share At: </p>
                <a href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="#">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="">
    <div class="" style="margin: 80px 190px;">
        <p style="font-size: 16px;">Reviews</p>
        <hr>
        <div class="row d-flex justify-content-center chat-box rounded" style="overflow-y: scroll; height:200px; align-content: flex-start;">
            <?php if (!empty($message)) {
                foreach ($message as $key => $value) {
                ?>
                    <div class="d-flex flex-start mt-4">
                        <img class="rounded-circle shadow-1-strong me-3" style="width: 40px; height: 40px;" src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1697087993~exp=1697088593~hmac=2fea8f0f3e1a74bbe86e9bff01aa81f11be80c85ca96617453b2012e6ebc7d9a" alt="avatar" width="65" height="65" />
                        <div class="flex-grow-1 flex-shrink-1">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        Votien dat<span class="small">' . $row['created_at'] . ' - ' . $row['id'] . ' hours ago</span>
                                    </p>
                                    <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a>
                                </div>
                                <p class="small text-mess mb-0" style="width: 700px;">
                                    <?php echo $value['message'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
    
                <?php
                }
            } else {
                ?>  
                    <h4>Chưa có bình luận nào</h4>
                <?php
            }
            ?>
        </div>
        <?php if (isset($orderItem)) {
        ?>
            <div class="d-flex flex-start w-100 mt-4">
                <img class="rounded-circle shadow-1-strong me-3" style="width: 40px; height: 40px;" src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1697087993~exp=1697088593~hmac=2fea8f0f3e1a74bbe86e9bff01aa81f11be80c85ca96617453b2012e6ebc7d9a" alt="avatar" width="40" height="40" />
                <form style="padding: 0; margin: 0; box-shadow: none; float: left;" action="/product-detail" method="post" class="form_comment w-100" id="form_comment">
                    <div class="d-flex" style="width: 40%;">
                        <input type="text" class="incoming_id" name="product_id" value="<?php echo $_GET['id'] ?? null; ?>" hidden>
                        <input type="text" class="input-field border w-100 px-2" style="border-radius: 12px; height: 50px;" name="message" placeholder="Type a message here..." autocomplete="off">
                        <button class="px-4 btn btn-primary send-btn" name="submit_comment"><i class="fab fa-telegram-plane"></i></button>
                    </div>
                </form>
            </div>
        <?php
        } ?>
    </div>
</div>