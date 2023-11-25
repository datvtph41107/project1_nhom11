<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use Exception;

class IsAdmin 
{
    public function checkAdmin(Response $res) {
        $res->redirect('/admin');
    }
}  