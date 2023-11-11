<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "TheCodeholic"
        ];
        return $this->render('home', $params);
    }
    public function contact()
    {
        return $this->render('contact');
    }

    // goi method trong class truyen param thi phai add vao param call_user_
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'handling Submit data';
    }
}