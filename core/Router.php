<?php 
namespace app\core;

use app\core\exception\NotFoundException;

/**
 * routes = [
 *   'get' => [
 *        '/' => function
 *        '/contact' => function
 *    ],
 *   'post' => [
 *        '/' => function
 *        '/contact' => function
 *    ],
 * ]
 * @package app\core
 *
 */

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback, ?array $authMiddleware = [], ?array $checkAdmin = [])
    {
        $this->routes['get'][$path] = [
            $callback,
            $authMiddleware,
            $checkAdmin
        ];
    }
    public function post($path, $callback, ?array $authMiddleware = [], ?array $checkAdmin = [])
    {
        $this->routes['post'][$path] =  [
            $callback,
            $authMiddleware,
            $checkAdmin
        ];;
    }
    // function resolve return tra ve du lieu
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path][0] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $callback[0] = $controller;

            $getMiddleware = $this->routes['get'][$path][1] ?? [];
            $getAuthAdmin = $this->routes['get'][$path][2] ?? [];
           
            foreach ($getAuthAdmin as $admin) {
                $instance = new $admin();
                $userAdmin = Application::$app->session->get('userAdmin');
                if (!$userAdmin) {
                    $instance->checkAdmin($this->response);
                }
            }
            foreach ($getMiddleware as $value) {
                $instance = new $value();
                $instance->handle($this->response);
            }
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderAdmin($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderViewAdmin($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    // display main view for app
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    // layouts view
    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller->layout ?? false) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        // luu tru vao ob tra ve khi goi ham
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
    // main view
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            // $$key like a variable
            $$key = $value;
            // extract -> $name
        }
        // Luu vao bo nho dem => duoc luu vao fc nay va k tra ve cho trinh duyet
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    protected function renderViewAdmin($view, $params)
    {
        foreach ($params as $key => $value) {
            // $$key -> la mot bien de co the thanh $model
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/admin/$view.php";
        return ob_get_clean();
    }
}