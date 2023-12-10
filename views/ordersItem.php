<style>
    @import url('https://fonts.googleapis.com/css?family=Assistant');

    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #fff;
        border-bottom: 5px solid transparent;
        /*background-color: gold;*/
        background-clip: padding-box;
    }

    thead {
        background: #dddcdc;
    }

    .toggle-btn {
        width: 40px;
        height: 21px;
        background: grey;
        border-radius: 50px;
        padding: 3px;
        cursor: pointer;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn>.inner-circle {
        width: 15px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn.active {
        background: blue !important;
    }

    .btn.btn-success {
        visibility: visible;
    }

    .toggle-btn.active>.inner-circle {
        margin-left: 19px;
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <h3 class="mb-4 fw-bold">Order Item</h3>
            <hr>
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table p-4">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>status</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                            foreach ($model as $value) {
                                extract($value);
                            ?>
                                <tr class="cell-1">
                                    <td>#<?= $id ?></td>
                                    <td>
                                        <button type="button" class="btn <?= $status === 'paid' ? 'btn-success' : 'btn-secondary' ?> ">
                                            <?= $status ?>
                                        </button>
                                    </td>
                                    <td><?= number_format($total_price, 2) ?></td>
                                    <td><?= $created_at ?></td>
                                    <td>
                                        <a href="/payments-detail?id=<?= $id ?>">
                                            <button class="btn btn-primary">
                                                <i class="fa-solid fa-file-invoice"></i>
                                                View Invoice
                                            </button>
                                        </a>
                                        <?php
                                        if ($status === 'unpaid') {
                                        ?>
                                            <a href="https://checkout.stripe.com/c/pay/<?= $session_uri ?> ">
                                                <button class="btn btn-dark">
                                                    <i class="fa-solid fa-credit-card"></i>
                                                    Pay
                                                </button>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>