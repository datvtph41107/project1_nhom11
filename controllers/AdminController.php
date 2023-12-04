<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\AddCategory;
use app\models\Category;
use app\models\LoginAdmin;
use app\models\Product;
use app\models\User;

class AdminController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginAdmin = new LoginAdmin();
        if ($request->isPost()) {
            // load du lieu submit register
            $loginAdmin->loadData($request->getBody());

            if ($loginAdmin->validateModel() && $loginAdmin->checkAdmin()) {
                $response->redirect('/dashboard');
                return;
            }
            $this->setLayout('admin');
            return $this->renderAdmin('login', [
                'model' => $loginAdmin,
            ]);
        }
        $this->setLayout('admin');
        return $this->renderAdmin('login', [
            'model' => $loginAdmin,
        ]);
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }

    public function dashboard()
    {
        $this->setLayout('adminPannel');
        return $this->renderAdmin('dashboard');
    }

    // User
    public function user()
    {
        $user = new User();
        $result = $user->fetchAll($user->attributes());
        $this->setLayout('adminPannel');
        return $this->renderAdmin('user/user', [
            'model' => $user,
            'result' => $result
        ]);
    }
    public function addUser(Request $request, Response $response)
    {
        $addUser = new User();
        if ($request->isPost()) {
            $addUser->loadData($request->getBody());
            // $addUser->category_category_id = intval($addUser->category_category_id);
            // var_dump($addUser->category_category_id);
            // exit;
            if ($addUser->validateModel() && $addUser->save() ) {
                Application::$app->session->setFlash('success', 'Thêm thành công !!!');
                $response->redirect('admin-adduser');
                exit;
            }
            $this->setLayout('adminPannel');
            return $this->renderAdmin('user/addUser', [
                'model' => $addUser,
            ]);
        }
        $this->setLayout('adminPannel');
        return $this->renderAdmin('user/addUser', [
            'model' => $addUser,
        ]);
    }
    public function updateUser()
    {
        $this->setLayout('adminPannel');
        return $this->renderAdmin('user/addUser');
    }
    public function deleteUser()
    {
        $this->setLayout('adminPannel');
        return $this->renderAdmin('user/addUser');
    }

    // Product
    public function product()
    {
        $productData = new Product();
        $result = $productData->fetchAll($productData->attributes());
        $this->setLayout('adminPannel');
        return $this->renderAdmin('product/product',  [
            'model' => $result
        ]);
    }
    public function addProduct(Request $request, Response $response)
    {
        $categoryData = new Category();
        $result = $categoryData->fetchAll($categoryData->attributes());

        $addProduct = new Product();
        if ($request->isPost()) {
            $addProduct->loadData($request->getBody());
            $addProduct->category_category_id = intval($addProduct->category_category_id);
            // var_dump($addProduct->category_category_id);
            // exit;
            if ($addProduct->validateModel() && $addProduct->CheckForm() && $addProduct->save() ) {
                Application::$app->session->setFlash('success', 'Thêm thành công !!!');
                $response->redirect('admin-addproduct');
                exit;
            }
            $this->setLayout('adminPannel');
            return $this->renderAdmin('product/addProduct', [
                'model' => $addProduct,
                'result' => $result
            ]);
        }
        $this->setLayout('adminPannel');
        return $this->renderAdmin('product/addProduct', [
            'model' => $addProduct,
            'result' => $result
        ]);
    }
    public function updateProduct(Request $request, Response $response)
    {
        $category = new Category();
        $updateProduct = new Product();
        $categoryData = $category->fetchAll($category->attributes());
        $result = $updateProduct->findOne(['product_id' => $_GET['id']]);
        if ($request->isPost()) {
            $updateProduct->loadData($request->getBody());
            if (empty($updateProduct->product_image)) {
                $updateProduct->product_image = $result->product_image;
            }
            
            if ($updateProduct->validateModel() && $updateProduct->update(['product_id' => $result->product_id])) {
                Application::$app->session->setFlash('success', 'Thêm thành công !!!');
                $response->redirect('admin-product');
                exit;
            }
        }
        $this->setLayout('adminPannel');
        return $this->renderAdmin('product/updateProduct', [
            'model' => $updateProduct,
            'result' => $result,
            'category' => $categoryData
        ]);
    }
    public function deleteProduct(Request $request, Response $response)
    {
        $deleteProduct = new Product();
        if ($deleteProduct->delete(['product_id' => $_GET['id']])) {
            Application::$app->session->setFlash('delete', 'Xóa dữ liệu thành công');
            $response->redirect('/admin-product');
        }
    }

    // Category 
    public function category()
    {
        $categoryData = new Category();
        // truyen fetch la 1 mang
        $result = $categoryData->fetchAll($categoryData->attributes());
        $this->setLayout('adminPannel');
        // category/category tên thư mục và tên file
        return $this->renderAdmin('category/category',  [
            'model' => $result
        ]);
    }
    public function addCategory(Request $request, Response $response)
    {
        $addCategory = new Category();
        if ($request->isPost()) {
            $addCategory->loadData($request->getBody());
            if ($addCategory->validateModel() && $addCategory->save()) {
                Application::$app->session->setFlash('success', 'Thêm thành công !!!');
                $response->redirect('admin-addcategory');
                exit;
            }
            $this->setLayout('adminPannel');
            return $this->renderAdmin('category/addCategory', [
                'model' => $addCategory,
            ]);
        }
        $this->setLayout('adminPannel');
        return $this->renderAdmin('category/addCategory', [
            'model' => $addCategory,
        ]);
    }
    public function updateCategory(Request $request, Response $response)
    {
        $updateCategory = new Category();
        $result = $updateCategory->findOne(['category_id' => $_GET['id']]);
        if ($request->isPost()) {
            $updateCategory->loadData($request->getBody());
            if ($updateCategory->validateModel() && $updateCategory->update(['category_id' => $result->category_id])) {
                Application::$app->session->setFlash('update', 'Cập nhật thành công !!!');
                $response->redirect('admin-category');
                exit;
            }
        }
        $this->setLayout('adminPannel');
        return $this->renderAdmin('category/updateCategory', [
            'model' => $updateCategory,
            'result' => $result
        ]);
    }
    public function deleteCategory(Request $request, Response $response)
    {
        $deleteCategory = new Category();
        if ($deleteCategory->delete(['category_id' => $_GET['id']])) {
            Application::$app->session->setFlash('delete', 'Xóa dữ liệu thành công');
            $response->redirect('/admin-category');
        }
    }
}