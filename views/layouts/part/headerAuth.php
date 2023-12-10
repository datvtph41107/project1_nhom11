<header class="bg-white d-flex" style="height: 72px; width: 100%; padding: 0 32px; position: sticky;">
    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
        <div class="d-flex" style=" height: 100%; ">
            <a href="/" class="d-flex align-items-center" style="    margin-right: 52px;">
                <div class="logo-head" style="height: 115px;" >
                    <img class="h-100" src="assets/image/logo.png" alt="">
                    <span style="color: black;">Dress in the colors of yourself</span>
                </div>
                <!-- <span class="logo-title">OpenShop</span> -->
            </a>
            <div class="logo-div">
                <ul class="list-contain mb-0 h-100">
                    <li class="list-item ms-4">
                        <a href="/about" style="text-decoration: none; color: black;">Thông tin</a>
                    </li>
                    <li class="list-item">
                        <a href="/contact" style="text-decoration: none; color: black;">Tương tác</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="middle">
        <?php
        use app\core\Application;
        ?>
        <div class="wrapper border">
            <div class="icon">
                <i class="fa-solid fa-magnifying-glass icon-move"></i>
            </div>
            <input style="color: black;" class="search-input" placeholder="Tìm kiếm bộ sưu tập của bạn" />
            <div class="icon-right">
                <div class="background">/</div>
            </div>
        </div>

        </div>
        <div class="right">
            <div class="d-flex">
                <?php if (Application::isGuest()): ?>
                    <div class="dropdown">
                        <button style="display: none;" disabled="disabled"></button>
                        <!-- <button style="background-color: transparent;"></button> -->
                        <a href="/login" style="color: black;" class="right-first">Đăng nhập</a>
                    </div>
                    <div class="cart-block" style="display: none;"></div>
                    <div class="dropdown">
                        <a href="/register" style="color: black;" class="right-second">
                            Đăng ký
                        </a>
                    </div>
                <?php else: ?>
                    <div class="dropdown" style="height: 48px;">
                        <button style="border-radius: 12px; height:100%; background-color: rgba(255, 255, 255, 0.12); color: rgb(255, 255, 255); backdrop-filter: blur(20px)" class="infor-right-border display-border d-flex align-items-center btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img  style="height: 100%; border-radius: 30px;" src="<?php echo Application::$app->userExists->avatar === '' ? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp' : Application::$app->userExists->avatar ?>"" alt="img">
                            <a style="margin-left: 6px; color:black;" ><?php echo Application::$app->userExists->getUserName() ?></a>
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
                                    <i class="fa-solid fa-wallet"></i>
                                </div>
                                <a style="padding-left: 4px;" class="dropdown-item" href="/payments">Hóa đơn</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>
                                <a style="padding-left: 4px;" class="dropdown-item" href="/logout">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                    <div class="">
                        <a href="/cart" style="border-radius: 12px; color:black;" class="infor-right-border cart-block ">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</header>
