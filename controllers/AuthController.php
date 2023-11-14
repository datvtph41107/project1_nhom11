<?php
namespace app\controllers;

// controller cau hinh layout

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\LoginUser;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginUser = new LoginUser();
        if ($request->isPost()) {
            // load du lieu submit register
            $loginUser->loadData($request->getBody());

            if ($loginUser->validateModel() && $loginUser->Checklogin()) {
                // nếu validateModel() true && $logiUser->register() gọi hàm này và trả về dữ liệu 
                // Success register điều hướng
                Application::$app->response->redirect('/');
                return;
            }
            // echo '<pre>';
            // var_dump($logiUser->errors);
            // echo '</pre>';
            $this->setLayout('auth');
            return $this->render('login', [
                'model' => $loginUser,
            ]);
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginUser,
        ]);
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
            // echo '<pre>';
            // var_dump($user->errors);
            // echo '</pre>';
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $user,
            ]);
        }
        return $this->render('register', [
            'model' => $user,
        ]);
        $this->setLayout('auth');
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }
}