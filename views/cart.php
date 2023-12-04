<style>
.title{
    margin-bottom: 5vh;
}
.card{
    padding-top: 40px;
    margin: auto;
    max-width: 1350px;
    width: 90%;
    border-radius: 1rem;
    border: transparent;
}
@media(max-width:767px){
    .card{
        margin: 3vh auto;
    }
}
/* .cart{
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
} */
@media(max-width:767px){
    .cart{
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}
.summary{
    background-color: rgb(247, 247, 247);
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
}
@media(max-width:767px){
    .summary{
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
    }
}
.summary .col-2{
    padding: 0;
}
.summary .col-10
{
    padding: 0;
}.row{
    margin: 0;
}
.title b{
    font-size: 1.5rem;
}
.main{
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}
.col-2, .col{
    padding: 0 1vh;
}
a{
    padding: 0 1vh;
}
.close{
    margin-left: auto;
    font-size: 0.7rem;
}
.img-cart{
    width: 3.5rem;
}
.back-to-shop{
    margin-top: 4.5rem;
}
h5{
    margin-top: 4vh;
}
hr{
    margin-top: 1.25rem;
}
.form-card {
    background-color: transparent;
    width: 250px;
    padding: 2vh 0;
    box-shadow: none;
}
select{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}

.price-change {
    width: 80px;
}
/* input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
} */

.border {
    padding: 2px 16px;
}

a{
    color: black; 
}
a:hover{
    color: black;
    text-decoration: none;
}
 #code{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}
</style>

<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">3 items</div>
                </div>
            </div>
            <div class="border-top border-bottom">
                <?php 
                    $quantity = '';
                    foreach ($model as $key => $cartItem) {
                        ?>
                            <div id="<?php echo $cartItem['product_id'] ?>" class="cart-center row border-bottom block-cart-item">
                                <div class="row main align-items-center">
                                    <div class="col-2"><img class="img-cart img-fluid" src="<?php echo $cartItem['product_image'] ?>"></div>
                                    <div class="col">
                                        <div class="row text-muted"><?php echo $cartItem['name'] ?></div>
                                        <div class="row"><?php echo $cartItem['product_name'] ?></div>
                                    </div>
                                    <div class="col">
                                        <input style="border: 1px solid #dee2e6; width: 60px;" class="px-2 cart-quantity" name="quantity" type="number" min="0" value="<?php echo $cartItem['quantity'] ?>" id="quantityInput">
                                    </div>
                                    <?php 
                                    $priceTotal = $cartItem['price'] * $cartItem['quantity'];
                                    ?>
                                    <div class="col d-flex">
                                        <span class=" price-change">
                                            <?php echo number_format($priceTotal, 3) ?>
                                        </span>₫
                                        <div class="">
                                        <a href="/cart?id=<?php echo $cartItem['cart_id'] ?>">
                                            <span onclick="return confirm('Are you sure you want to delete?')" class="close ps-4 ms-4" style="cursor: pointer;">
                                                <i style="font-size: 16px;" class="fa-solid fa-trash"></i>
                                            </span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
            <div style="cursor: pointer;" onclick="window.history.back();" class="back-to-shop">
                &leftarrow;
                <span class="text-muted">Back to shop</span>
            </div>
        </div>
        <div class="col-md-4 summary" style="height: 100%;">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS</div>
                <div class="col text-right"><?php echo $quantity ?></div>
            </div>
            <form class="form-card ms-0">
                <div class="d-flex justify-content-between">
                    <p>SHIPPING</p>
                    <span>Free</span>
                    <!-- <select>
                        <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                    </select> -->
                </div>
                <!-- <p>GIVE CODE</p>
                <input id="code" placeholder="Enter your code"> -->
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right price-total"><?php echo $totalPrice ?></div>
            </div>
            <a href="/checkout">
                <button class="btn btn-primary w-100 mt-4" style="height: 40px;">CHECKOUT</button>
            </a>
        </div>
    </div>

</div>