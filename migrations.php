<?php
require_once __DIR__ . '/vendor/autoload.php';
// cmd -> php migrations.php de chay file nay 
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// dirname(__DIR__) get ROOT
// echo __DIR__; Lấy địa chỉ của thư mục hiện tại
// echo (dirname(__DIR__)); lấy thư mục cha của thư mục hiện tại
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(__DIR__, $config);

$app->db->runMigrations();
?>