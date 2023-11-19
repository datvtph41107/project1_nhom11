<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\core\middlewares\AuthMiddleware;

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
// Auth Controller
$app->router->get('/profile', [AuthController::class, 'profile'], [AuthMiddleware::class]);
$app->router->get('/cart', [AuthController::class, 'cart'], [AuthMiddleware::class]);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
// Admin
$app->router->get('/admin', [AdminController::class, 'login']);
$app->router->post('/admin', [AdminController::class, 'login']);
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard'], [AuthMiddleware::class]);

$app->run();
?>