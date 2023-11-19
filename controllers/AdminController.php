<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginAdmin;

class AdminController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginAdmin = new LoginAdmin();
        if ($request->isPost()) {
            // load du lieu submit register
            $loginAdmin->loadData($request->getBody());

            if ($loginAdmin->validateModel() && $loginAdmin->checkAdmin()) {
                $response->redirect('admin/dashboard');
                return;
            }
            $this->setLayout('admin');
            return $this->renderAdmin('login', [
                'model' => $loginAdmin,
            ]);
        }
        if (Application::isGuest()) {
            $this->setLayout('admin');
            return $this->renderAdmin('login', [
                'model' => $loginAdmin,
            ]);
        }else {
            Application::$app->response->redirect('/admin/dashboard');
        }
    }

    public function dashboard()
    {
        $this->setLayout('admin');
        return $this->renderAdmin('dashboard');
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }
}