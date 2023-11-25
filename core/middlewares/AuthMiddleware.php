<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use Exception;

class AuthMiddleware implements BaseMiddleware
{
    public array $actions = [];
    // Request $req, Response $res, callable $next
    public function handle(Response $res) {
        if (Application::isGuest()) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            $res->redirect('/login');
        }
    }
}  