<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\Response;

class AuthMiddleware implements BaseMiddleware
{
    public array $actions = [];
    // Request $req, Response $res, callable $next
    public function handle(Response $res) {
        if (Application::isGuest()) {
            // Chưa đăng nhập, chuyển hướng đến trang đăng nhập
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            $res->redirect('/login');
        }
    }

    public function isAdmin(Response $res) {
        if (Application::isGuest()) {
            // Chưa đăng nhập, chuyển hướng đến trang đăng nhập
            // $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            $res->redirect('/admin');
        }
    }
}  