<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\CheckoutController;
use app\controllers\PaymentController;
use app\controllers\SiteController;
use app\core\Application;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\IsAdmin;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// dirname(__DIR__) get ROOT
// echo __DIR__; Lấy địa chỉ của thư mục hiện tại
// echo (dirname(__DIR__)); lấy thư mục cha của thư mục hiện tại
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(dirname(__DIR__), $config);

// method param 2 se duoc goi nhu la 1 bien tinh trong call_user_function
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->router->get('/profile', [SiteController::class, 'profile'], [AuthMiddleware::class]);
$app->router->get('/cart', [SiteController::class, 'cart'], [AuthMiddleware::class]);
$app->router->post('/cart', [SiteController::class, 'handleCart'], [AuthMiddleware::class]);
$app->router->get('/checkout', [CheckoutController::class, 'order'], [AuthMiddleware::class]);
$app->router->post('/checkout', [CheckoutController::class, 'checkout'], [AuthMiddleware::class]);
$app->router->post('/checkout-update', [CheckoutController::class, 'orderUpdate'], [AuthMiddleware::class]);
$app->router->get('/checkout/success', [CheckoutController::class, 'success'], [AuthMiddleware::class]);
$app->router->get('/checkout/failure', [CheckoutController::class, 'failure'], [AuthMiddleware::class]);
$app->router->get('/payments', [PaymentController::class, 'paymentHistory'], [AuthMiddleware::class]);

$app->router->get('/product', [SiteController::class, 'product']);
$app->router->post('/product', [SiteController::class, 'handleProduct']);
$app->router->get('/product-detail', [SiteController::class, 'productDetail']);
$app->router->post('/product-detail', [SiteController::class, 'handleProductDetail'], [AuthMiddleware::class]);
// Auth Controller
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
// Admin
$app->router->get('/admin', [AdminController::class, 'login']);
$app->router->post('/admin', [AdminController::class, 'login']);
$app->router->get('/dashboard', [AdminController::class, 'dashboard'], [AuthMiddleware::class], [IsAdmin::class]);
// User Admin
$app->router->get('/admin-user', [AdminController::class, 'user'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-adduser', [AdminController::class, 'addUser'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-adduser', [AdminController::class, 'addUser'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-updateuser', [AdminController::class, 'updateUser'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-updateuser', [AdminController::class, 'updateUser'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-deleteuser', [AdminController::class, 'deleteUser'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-deleteuser', [AdminController::class, 'deleteUser'], [AuthMiddleware::class], [IsAdmin::class]);
// Product Admin
$app->router->get('/admin-product', [AdminController::class, 'product'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-addproduct', [AdminController::class, 'addProduct'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-addproduct', [AdminController::class, 'addProduct'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-updateproduct', [AdminController::class, 'updateProduct'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-updateproduct', [AdminController::class, 'updateProduct'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-deleteproduct', [AdminController::class, 'deleteProduct'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-deleteproduct', [AdminController::class, 'deleteProduct'], [AuthMiddleware::class], [IsAdmin::class]);
// Category Admin
$app->router->get('/admin-category', [AdminController::class, 'category'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-addcategory', [AdminController::class, 'addCategory'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-addcategory', [AdminController::class, 'addcategory'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-updatecategory', [AdminController::class, 'updateCategory'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-updatecategory', [AdminController::class, 'updateCategory'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->get('/admin-deletecategory', [AdminController::class, 'deleteCategory'], [AuthMiddleware::class], [IsAdmin::class]);
$app->router->post('/admin-deletecategory', [AdminController::class, 'deleteCategory'], [AuthMiddleware::class], [IsAdmin::class]);

$app->run();
?>