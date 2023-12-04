<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- echo getcwd(); -->
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</head>

<body>
    <div class="app-center">
        <div class="app" style="width: 100%;">
            <?php
            if ($_SERVER['REQUEST_URI'] == '/') {
                require 'part/header.php';
            } else {
                require 'part/headerAuth.php';
            }
            ?>

            {{content}}

            <div class="container">
                <footer class="row row-cols-5 py-5 my-5 border-top">
                    <div class="col">
                        <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                            <svg class="bi me-2" width="40" height="32">
                                <use xlink:href="#bootstrap"></use>
                            </svg>
                        </a>
                        <p class="text-muted">© 2021</p>
                    </div>

                    <div class="col">

                    </div>

                    <div class="col">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>

                    <div class="col">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>

                    <div class="col">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script>
        const form = document.getElementById('purchaseForm');
        const $ = document.querySelector.bind(document);
        const $$ = document.querySelectorAll.bind(document);
        const scrollDemo = $(".app");
        const output = $("header");
        const a = $$("header a");
        const search = $("header .wrapper")
        const infor = $(".dropdown button");
        const cartBlock = $(".cart-block");
        const cartNotify = $(".box-notify");
        const btnCart = $(".btn-addtocar");
        const cartQuantity = $$(".cart-quantity");
        const priceCartChange = $('.price-change');
        const priceTotal = $('.price-total');
        const cartCenter = $$('.cart-center');
        const loadingIndicator = $(".loading-indicator");
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');
        const productGender = urlParams.get('gender');
        const fillterContainer = $(".filter-container");

        const categoryFilter = $$(".category-filter");
        const checkFilter = $$(".filter-check");
        // console.log(checkFilter);
        // scroll header change
        categoryFilter.forEach((category) => {
            category.addEventListener('click', (e) => {
                const categoryId = e.target.id;
                const checkedElements = Array.from(checkFilter)
                    .filter((checkbox) => checkbox.checked)
                    .map((checkbox) => checkbox.id);
                const xhrRequest = new XMLHttpRequest();
                xhrRequest.open('POST', '/product', true);
                xhrRequest.setRequestHeader('Content-Type', 'application/json');

                xhrRequest.onload = function() {
                    if (xhrRequest.readyState === XMLHttpRequest.DONE) {
                        if (xhrRequest.status === 200) {
                            showLoadingIndicator();
                            fillterContainer.innerHTML = '';
                            setTimeout(() => {
                                const responseData = xhrRequest.response;
                                // document.body.innerHTML = responseData;
                                fillterContainer.innerHTML = responseData;
                                hideLoadingIndicator();
                            }, 1500);
                        } else {
                            // Xử lý phản hồi lỗi
                            console.log('Request failed with status:', xhrRequest.status);
                        }
                    }
                }

                const formData = {
                    idCategoryValue: categoryId,
                    idGender: checkedElements ,
                };
                xhrRequest.send(JSON.stringify(formData));
            })
        })

        checkFilter.forEach((check) => {
            check.addEventListener('change', (e) => {
                const checkedElements = Array.from(checkFilter)
                    .filter((checkbox) => checkbox.checked)
                    .map((checkbox) => checkbox.id);

                // `checkedElements` giờ đây chứa mảng các phần tử được chọn
                const xhrCheck = new XMLHttpRequest();
                xhrCheck.open('POST', '/product', true);
                xhrCheck.setRequestHeader('Content-Type', 'application/json');

                xhrCheck.onload = function() {
                    if (xhrCheck.readyState === XMLHttpRequest.DONE) {
                        if (xhrCheck.status === 200) {
                            showLoadingIndicator();
                            fillterContainer.innerHTML = '';
                            setTimeout(() => {
                                const responseData = xhrCheck.response;
                                // document.body.innerHTML = responseData;
                                fillterContainer.innerHTML = responseData;
                                hideLoadingIndicator();
                            }, 1500);
                        } else {
                            // Xử lý phản hồi lỗi
                            console.log('Request failed with status:', xhrCheck.status);
                        }
                    }
                }
                const formData = {
                    idGender: checkedElements ,
                };
                xhrCheck.send(JSON.stringify(formData));
            })
        })

        if (window.location.pathname === '/') {
            window.onscroll = function() {
                slideShow();
                scrollFunction()
            };
        } else {
            cartQuantity.forEach((quantity) => {
                quantity.addEventListener('change', function(e) {
                    const productCartId = e.target.parentElement.parentElement.parentElement.id;
                    const productCartItem = e.target.parentElement.parentElement.parentElement;

                    const cartQuantityValue = quantity.value;
                    const childrenCartItem = productCartItem.querySelector('.price-change');

                    const xhrRefresh = new XMLHttpRequest();
                    xhrRefresh.open('POST', '/cart', true);
                    xhrRefresh.setRequestHeader('Content-Type', 'application/json');

                    xhrRefresh.onload = function() {
                        if (xhrRefresh.readyState === XMLHttpRequest.DONE) {
                            if (xhrRefresh.status === 200) {
                                const responseData = xhrRefresh.response;
                                const parsedData = JSON.parse(responseData);
                                // document.body.innerHTML = responseData;
                                childrenCartItem.innerHTML = parsedData.fetchPrice;
                                priceTotal.innerHTML = parsedData.total;
                            } else {
                                // Xử lý phản hồi lỗi
                                console.log('Request failed with status:', xhrRefresh.status);
                            }
                        }
                    }

                    const formData = {
                        id: productCartId,
                        quantity: cartQuantityValue
                    };
                    xhrRefresh.send(JSON.stringify(formData));
                });
            })
            //      Add cart reload
            document.getElementById('productForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Chặn sự kiện mặc định của form
                const quantity = document.getElementById('quantityInput').value;

                // Thực hiện các bước xử lý của bạn, ví dụ: gửi yêu cầu Ajax
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/product-detail', true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onload = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            const responseData = xhr.responseText;
                            const parsedData = JSON.parse(responseData);

                            if (parsedData.redirect) {
                                // Chuyển hướng đến URL được chỉ định
                                window.location.href = parsedData.redirect;
                            } else {
                                // Xử lý các phản hồi JSON khác
                                // console.log(xhr.response);
                                // Xử lý phản hồi thành công
                                cartNotify.classList.add('appear');
                                setTimeout(function() {
                                    cartNotify.classList.remove('appear');
                                    // Xóa nội dung của resultDiv để ẩn đi
                                }, 6000);
                            }

                        } else {
                            // Xử lý phản hồi lỗi
                            console.log('Request failed with status:', xhr.status);
                        }

                    }
                };

                // Gửi dữ liệu form dưới dạng JSON
                const formData = {
                    id: productId,
                    quantity: quantity
                };
                xhr.send(JSON.stringify(formData));
            });


        }

        function showLoadingIndicator() {
            loadingIndicator.style.display = 'block';
        }

        // Function to hide the loading indicator
        function hideLoadingIndicator() {
            loadingIndicator.style.display = 'none';
        }
        // Change input quantity

        function removeNotifyCart() {
            cartNotify.classList.remove('appear');
        }

        function scrollFunction() {
            if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
                output.classList.remove('bg-transparent');
                output.classList.add('bg-white');
                infor.classList.add('infor-right-border');
                cartBlock.classList.add('infor-right-border');
                a.forEach((item) => {
                    item.classList.add('text-black')
                })
                search.classList.add("border");
            } else {
                a.forEach((item) => {
                    item.classList.remove('text-black')
                })
                output.classList.add('bg-transparent');
                search.classList.remove("border");
                infor.classList.remove("infor-right-border");
                cartBlock.classList.remove("infor-right-border");
            }
        }


        const slideImgs = $$('.container__slide-item');
        let imgIndex = 2;

        function slideShow() {
            const slideImgFirst = $('.container__slide-item.first')
            const slideImgSecond = $('.container__slide-item.second')
            const slideImgThird = slideImgs[imgIndex]
            // 0,1,2--imgIndex
            // -------------------slideImgs[imgIndex = 2] == same like contain in() container-slide-item second
            const slideImgFourth = slideImgs[imgIndex === slideImgs.length - 1 ? 0 : imgIndex + 1]
            // ------------------------------NẾU imgIndex = slideImgs.length-1 = 13 nếu đúng thì lọt vào bằng 0 nếu sai thì lọt vào imgIndex + 1
            slideImgFourth.classList.replace('fourth', 'third')
            slideImgThird.classList.replace('third', 'second')
            slideImgSecond.classList.replace('second', 'first')
            slideImgFirst.classList.replace('first', 'fourth')
            // slideImgFirst đang ở đầu tiên vào vòng lập đổi về fourth luôn
            imgIndex++;
            if (imgIndex >= slideImgs.length) {
                imgIndex = 0;
                // quay trở về cái đầu tiên và tiếp tục replace
            }
            // console.log(imgIndex)
            // console.log(slideImgs.length) đếm từ 1 còn imgIndex đếm từ 0 từ vị trí đầu tiên first  
            setTimeout(slideShow, 2000)
            // khi refresh web vòng lập bắt đầu first biến thành fourth imgIndex=2 bằng với item third
        }
    </script>
</body>

</html>