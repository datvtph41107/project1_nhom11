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
                    <div>
                        <a href="/login" class="right-first">Đăng nhập</a>
                    </div>
                    <div>
                        <a href="/register" class="right-second">Đăng ký</a>
                    </div>
                <?php else: ?>
                    <div class="dropdown" style="height: 48px;">
                        <button style="height:100%;" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 6px;" ><?php echo Application::$app->userExists->getUserName() ?></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</header>
