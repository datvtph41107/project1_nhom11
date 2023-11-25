<?php
namespace app\controllers;

// controller cau hinh layout

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginUser;
use app\models\RegisterUser;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginUser = new LoginUser();
        if ($request->isPost()) {
            // load du lieu submit register
            $loginUser->loadData($request->getBody());

            if ($loginUser->validateModel() && $loginUser->Checklogin()) {
                // nếu validateModel() true && $logiUser->register() gọi hàm này và trả về dữ liệu 
                // Success register điều hướng
                if (isset($_SESSION['redirect_url'])) {
                    // Chuyển hướng đến trang đã lưu trữ
                    $response->redirect($_SESSION['redirect_url']);
                    // Xóa session 'redirect_url' để tránh chuyển hướng lại nếu người dùng truy cập trực tiếp trang đăng nhập
                    unset($_SESSION['redirect_url']);
                } else {
                    // Nếu không có đường dẫn trước đó, chuyển hướng đến trang mặc định sau đăng nhập
                    $response->redirect('/');
                }
                return;
            }
            $this->setLayout('auth');
            return $this->render('login', [
                'model' => $loginUser,
            ]);
        }
        if (Application::isGuest()) {
            $this->setLayout('auth');
            return $this->render('login', [
                'model' => $loginUser,
            ]);
        }else {
            Application::$app->response->redirect('/');
        }
    }

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            // load du lieu submit register
            $user->loadData($request->getBody());

            if ($user->validateModel() && $user->save()) {
                // nếu validateModel() true && $user->register() gọi hàm này và trả về dữ liệu 
                // Success register điều hướng
                Application::$app->response->redirect('/');
            }
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $user,
            ]);
        }
        if (Application::isGuest()) {
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $user,
            ]);
        }else {
            Application::$app->response->redirect('/');
        }
        
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }

    public function cart()
    {
        return $this->render('cart');
        // return Application::$app->controller->render('profile');
    }

    public function product()
    {
        return $this->render('product');
        // return Application::$app->controller->render('profile');
    }
}