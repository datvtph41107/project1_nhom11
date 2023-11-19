<?php

use app\core\Application;

// echo '<pre>';
//  var_dump(Application::$app->userExists);
//  echo '</pre>';
 ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- echo getcwd(); -->
    <link rel="stylesheet" href="css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <div class="app-center">
        <div class="app" style="width: 100%;">
            <?php
                require 'part/header.php';
            ?>

            {{content}}

            <div class="container">
                <footer class="row row-cols-5 py-5 my-5 border-top">
                    <div class="col">
                        <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
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
        const scrollDemo = document.querySelector(".app");
        const output = document.querySelector("header");
        const a = document.querySelectorAll("header a");
        const search = document.querySelector("header .wrapper")

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
                output.classList.remove('bg-transparent');
                output.classList.add('bg-white');
                a.forEach((item) => {
                    item.classList.add('text-black')
                })
                search.classList.add("border");
            } else {
                console.log(123);
                a.forEach((item) => {
                    item.classList.remove('text-black')
                })
                output.classList.add('bg-transparent');
                search.classList.remove("border");
            }
        }
    </script>                       
</body>

</html>