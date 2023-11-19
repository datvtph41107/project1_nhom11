<?php 
namespace app\core;

class Application
{
    public static string $MY_INDEX;
    public static string $ROOT_DIR;
    public static Application $app;
    public string|array|null $action;
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?Controller $controller = null;
    // ?DbModel có thể nhận gtri null
    public ?DbModel $userExists;

    public function __construct($rootPath, array $config)
    {
        // use static to do not change value
        self::$MY_INDEX = __DIR__;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
        // GET CLASS SESSION\
        $primaryValue = $this->session->get('user');
        // id user
        // if (!isset($_SESSION['user'])) {
        //     echo 'Session variable unset successfully.';
        // } else {
        //     echo 'Failed to unset session variable.';
        // }
        if ($primaryValue) {
            $instance = new $this->userClass();
            // id name
            $primaryKey = $instance->primaryKey();
            // Tìm user có key là .... de co the lay dc thong tin global => Application::$app->userExists
            $this->userExists = $instance->findOne([$primaryKey => $primaryValue]);
        }else {
            $this->userExists = null;
        }
    }

    public function run()
    {
        // $this->router->resolve();
        // echo du lieu duoc tra ve cua fc resolve
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->router->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function getController(): \app\core\Controller
    {
        return $this->controller;
    }

    public function setController(\app\core\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public static function isGuest() 
    {
        // Khong phai user
        return !self::$app->userExists;
    }
    // set session user when query email user => $userChecking
    public function login(DbModel $userChecking)
    {
        // sau khi findOne sẽ được gán vào biến
        // gán user checking vào biến userExists
        $this->userExists = $userChecking;
        $primaryKey = $userChecking->primaryKey();
        $primaryValue = $userChecking->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function isAdmin(DbModel $userChecking)
    {
        $this->userExists = $userChecking;
        return true;
    }

    public function logout()
    {
        $this->userExists = null;
        $this->session->remove('user');
        $this->session->remove('userAdmin');
    }
}