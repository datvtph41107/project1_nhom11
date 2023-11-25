<header class="bg-transparent d-flex" style="height: 72px; width: 100%; padding: 0 32px;">
    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
        <div class="d-flex" style=" height: 100%; ">
            <a href="/" class="d-flex align-items-center" style="    margin-right: 52px;">
                <div class="logo-head" style="height: 115px;" >
                    <img class="h-100" src="assets/image/logo.png" alt="">
                    <span>Dress in the colors of yourself</span>
                </div>
                <!-- <span class="logo-title">OpenShop</span> -->
            </a>
            <div class="logo-div">
                <ul class="list-contain mb-0 h-100">
                    <li class="list-item ms-4">
                        <a href="/about" style="text-decoration: none;">Thông tin</a>
                    </li>
                    <li class="list-item">
                        <a href="/contact" style="text-decoration: none;">Tương tác</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="middle">
        <?php

        use app\core\Application;

        require 'search.php'
        ?>
        </div>
        <div class="right">
            <div class="d-flex">
                <?php if (Application::isGuest()): ?>
                    <div class="dropdown">
                        <button style="display: none;" disabled="disabled"></button>
                        <!-- <button style="background-color: transparent;"></button> -->
                        <a href="/login" class="right-first">Đăng nhập</a>
                    </div>
                    <div class="cart-block" style="display: none;"></div>
                    <div class="dropdown">
                        <a href="/register" class="right-second">
                            Đăng ký
                        </a>
                    </div>
                <?php else: ?>
                    <div class="dropdown" style="height: 48px;">
                        <button style="border-radius: 12px; height:100%; background-color: rgba(255, 255, 255, 0.12); color: rgb(255, 255, 255); backdrop-filter: blur(20px)" class="display-border d-flex align-items-center btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img  style="height: 100%; border-radius: 30px;" src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1697087993~exp=1697088593~hmac=2fea8f0f3e1a74bbe86e9bff01aa81f11be80c85ca96617453b2012e6ebc7d9a" alt="img">
                            <a style="margin-left: 6px;" ><?php echo Application::$app->userExists->getUserName() ?></a>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="d-flex align-items-center">
                                <div class="icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <a style="padding-left: 4px;" class="dropdown-item" href="/profile">Thông tin cá nhân</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>
                                <a style="padding-left: 4px;" class="dropdown-item" href="/logout">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <a href="/cart" style="border-radius: 12px;" class="cart-block ">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</header>
