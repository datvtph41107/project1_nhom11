<?php
namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller 
{
    // public string $action = '';
    public string $layout = 'main';
    protected array $middlewares = [];

    public function setLayout($layout) 
    {
        $this->layout = $layout;
    }
    
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function renderAdmin($view, $params = [])
    {
        return Application::$app->router->renderAdmin($view, $params);
    }
}