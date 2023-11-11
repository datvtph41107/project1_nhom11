<?php
namespace app\controllers;

// controller cau hinh layout
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            // load du lieu submit register
            $registerModel->loadData($request->getBody());

            if ($registerModel->validateModel() && $registerModel->register()) {
                // nếu validateModel() true && $registerModel->register() gọi hàm này và trả về dữ liệu 
                // Success register điều hướng
                return 'Succes';
            }
            // echo '<pre>';
            // var_dump($registerModel->errors);
            // echo '</pre>';
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $registerModel,
            ]);
        }
        return $this->render('register', [
            'model' => $registerModel,
        ]);
        $this->setLayout('auth');
    }
}