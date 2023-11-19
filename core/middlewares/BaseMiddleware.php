<?php
namespace app\core\middlewares;

use app\core\Response;

interface BaseMiddleware
{
    public function handle(Response $response);
}