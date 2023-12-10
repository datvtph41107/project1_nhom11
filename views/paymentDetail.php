<style>
    #progressbar-1 {
        color: #455A64;
    }

    #progressbar-1 li {
        list-style-type: none;
        font-size: 13px;
        width: 33.33%;
        float: left;
        position: relative;
    }

    #progressbar-1 #step1:before {
        content: "1";
        color: #fff;
        width: 29px;
        margin-left: 22px;
        padding-left: 11px;
    }

    #progressbar-1 #step2:before {
        content: "2";
        color: #fff;
        width: 29px;
    }

    #progressbar-1 #step3:before {
        content: "3";
        color: #fff;
        width: 29px;
        margin-right: 22px;
        text-align: center;
    }

    #progressbar-1 li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #455A64;
        border-radius: 50%;
        margin: auto;
    }

    #progressbar-1 li:after {
        content: '';
        width: 121%;
        height: 2px;
        background: #455A64;
        position: absolute;
        left: 0%;
        right: 0%;
        top: 15px;
        z-index: -1;
    }

    #progressbar-1 li:nth-child(2):after {
        left: 50%
    }

    #progressbar-1 li:nth-child(1):after {
        left: 25%;
        width: 121%
    }

    #progressbar-1 li:nth-child(3):after {
        left: 25%;
        width: 50%;
    }

    #progressbar-1 li.active:before,
    #progressbar-1 li.active:after {
        background: #1266f1;
    }

    .card-stepper {
        z-index: 0
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="container mb-5 mt-2 col-md-10 col-lg-8">
            <h2>Order Items</h2>
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #<?= $model[0]['id'] ?></strong></p>
                </div>
                <div class="col-xl-3 float-end">
                    <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                    <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <ul class="list-unstyled">
                        <li class="text-muted">To: <span style="color:#5d9fc5 ;"><?= $model[0]['firstname'] . ' ' . $model[0]['lastname'] ?></span></li>
                        <li class="text-muted"><?= $model[0]['address'] ?></li>
                        <li class="text-muted">State, Country</li>
                        <li class="text-muted"><i class="fas fa-phone"></i> <?= $model[0]['phone'] ?></li>
                    </ul>
                </div>
                <div class="col-xl-4">
                    <p class="text-muted">Invoice</p>
                    <ul class="list-unstyled">
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>#<?= $payment->id ?></li>
                        <?php
                        $date = $payment->created_at;
                        $timestamp = strtotime($date);
                        $formattedDateString = date("M j,Y", $timestamp);
                        ?>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span><?= $formattedDateString ?></li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge <?= $payment->status === 'paid' ? 'bg-success text-white' : 'bg-warning text-black' ?> fw-bold">
                                <?= $payment->status ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <section class="">
                <div class="py-5 h-100 w-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class=w-100">
                            <div class="card card-stepper" style="border-radius: 8px;">
                                <?php
                                $amount = [];
                                foreach ($model as $orderItem) {
                                    extract($orderItem);
                                    $amount[] = [
                                        'quantity' => $quantity,
                                        'price' => $price,
                                    ];
                                ?>
                                    <div class="px-4 pt-4">
                                        <div class="d-flex flex-row pb-2">
                                            <div class="border">
                                                <img style="width: 140px;" class="align-self-center img-fluid" src="<?= $product_image ?>" width="250">
                                            </div>
                                            <div class="flex-fill d-flex justify-content-between py-4 px-4">
                                                <div class="">
                                                    <h5 class="bold mb-0"><?= $product_name ?></h5>
                                                    <span class="bold" style="font-size: 14px; color: #707072;"><?= $description ?></span>
                                                    <p class="text-muted"> Qt: <?= $quantity ?> item</p>
                                                </div>
                                                <div class="" style="padding-right: 40px;">
                                                    <h4 class=""> <?= $price ?>đ </span></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-xl-8">
                    <p class="ms-3">Thêm ghi chú bổ sung và thông tin thanh toán</p>
                </div>
                <div class="col-xl-3">
                    <?php 
                        $quantity = 0;
                        $price = 0;
                        foreach ($amount as $value) {
                            $price += $value['price'] * $value['quantity'];
                        }
                        $totalPrice = number_format($price, 2);
                    ?>
                    <ul class="list-unstyled">
                        <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span><?= $totalPrice ?>đ</li>
                        <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Thuế</span>0.00đ</li>
                    </ul>
                    <p class="text-black float-start" style="width: 222px;"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;"><?= $totalPrice ?>đ</span></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-10">
                    <p>Thank you for your purchase</p>
                </div>
                    <?php
                    if ($payment->status === 'pending') {
                    ?>
                            <div class="col-xl-2">
                                <a href="https://checkout.stripe.com/c/pay/<?= $payment->session_uri ?>">
                                    <button type="button" class="btn btn-primary">Pay Now</button>
                                </a>
                            </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
</div>