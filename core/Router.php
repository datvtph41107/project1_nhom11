<?php 
namespace app\core;
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

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
// function resolve return tra ve du lieu
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        // get function in this method->path array
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            // Khoi tao class o doi so thu nhat
            // $siteController = new SiteController();
            // Define the callback
            // $callback = [$siteController, 'contact'];
            // la 1 array nen ta can lay tham so dau tien de khoi tao class
            // $controller = new app/callback() -> class
            Application::$app->controller = new $callback[0]();
            // gán gtri -> [SiteController::class, 'home']
            // $callback[0] -> SiteController::class = new SiteController::class()
            $callback[0] = Application::$app->controller;
        }
        // call function in array
        // doi so thu 2 la argument
        return call_user_func($callback, $this->request);
    }
    // display main view for app
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        // __DIR__ thu muc chua hien tai
        // param 2 check param 1 and param 3 replace 1 to 2
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    // NOT FOUND
    // public function renderContent($viewContent, $params = [])
    // {
    //     $layout = $this->layoutContent();
    //     $view = $this->renderOnlyView($viewContent, $params);
    //     return str_replace('{{content}}', $view, $layout);
    // }
    // layouts view
    protected function layoutContent()
    {
        Application::$app->controller = new Controller();
        $layout = Application::$app->controller->layout;
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
}