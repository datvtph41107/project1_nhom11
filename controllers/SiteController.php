<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\Category;
use app\models\Comment;
use app\models\OrderItem;
use app\models\Product;
use app\models\User;

class SiteController extends Controller
{
    public function home()
    {
        $product = new Product();

        $result = $product->fetchAll($product->attributes());
        return $this->render('home', [
            'model' => $result,
        ]);
    }

    public function handleHome()
    {
        $product = new Product();
        if (isset($_POST['debounceValue'])) {
            $debounceValue = $_POST['debounceValue'];
            $search = $product->fetchSearch($debounceValue);
            if (empty($search)) {
                $jsonResult = json_encode($search);
                echo $jsonResult;
            }
        }
        if (isset($search)) {
            $jsonData = []; // Mảng để chứa dữ liệu để encode sang JSON
            foreach ($search as $key => $value) {
                extract($value);
                // Tạo một mảng mới chứa dữ liệu của mỗi sản phẩm
                $productData = [
                    'product_image' => $product_image,
                    'product_name' => $product_name,
                    'description' => $description,
                    'price' => $price
                ];
                // Thêm mảng dữ liệu của mỗi sản phẩm vào mảng chính
                $jsonData[] = $productData;
            }

            // Chuyển đổi mảng thành chuỗi JSON
            $jsonString = json_encode($jsonData);

            // In chuỗi JSON hoặc truyền nó vào JavaScript để sử dụng
            echo $jsonString;
        }
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

    public function profile(Request $request, Response $response)
    {
        $user = new User();
        $result = $user->fetch(['id' => Application::$app->userExists->id]);
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            $user->password = $result->password;
            $user->update(['id' => Application::$app->userExists->id]);
        }
        return $this->render('profile', [
            'model' => $user,
            'infor' => $result,

        ]);
    }

    public function cart()
    {
        $product = new Product();
        $category = new Category();
        $cart = new Cart($quantity = null, $idProduct = null);
        $cartItem = $cart->fetchQuery(["product" => [$product->primaryKey(), $product->getUserName()]], ["category" => $category->primaryKey()], intval($cart->user_user_id));
        // DELETE CART
        if (isset($_GET['id'])) {
            if ($cart->delete(['cart_id' => intval($_GET['id'])])) {
                Application::$app->session->setFlash('delete', 'Xóa dữ liệu thành công');
                Application::$app->response->redirect('/cart');
                exit;
            }
        }
        $totalPrice = $cart->fetchTotalPrice(intval($cart->user_user_id));
        return $this->render('cart', [
            'model' => $cartItem,
            'totalPrice' => $totalPrice
        ]);
    }

    public function handleCart(Request $request, Response $response)
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        $idProduct = intval($requestData['id']);
        $quantity = intval($requestData['quantity']);
        // Rest of your PHP code...
        // var_dump($quantity, $idProduct);
        $product = new Product();
        $category = new Category();
        $addToCart = new Cart($quantity, $idProduct);
        $cartItem = $addToCart->fetchQuery(["product" => [$product->primaryKey(), $product->getUserName()]], ["category" => $category->primaryKey()], intval($addToCart->user_user_id));
        if ($request->isPost()) {
            $addToCart->loadData($request->getBody());
            // var_dump($addToCart->checkUser($response));
            if ($addToCart->checkUser($response) && $addToCart->updateCart($idProduct)) {
                $productPrice = $product->findOne(["product_id" => $idProduct]);
                $priceQuantity = $productPrice->price * $quantity;
                $totalPrice = $addToCart->fetchTotalPrice(intval($addToCart->user_user_id));
                $result = [
                    'total' => $totalPrice,
                    'fetchPrice' => number_format($priceQuantity, 3),
                ];
                $jsonResult = json_encode($result);
                echo $jsonResult;
                exit;
            }
        }
    }

    public function product()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        $dataCategoryId = $requestData['idCategoryValue'] ?? [];
        $product = new Product();
        $category = new Category();
        $result = $product->fetchAll($product->attributes());
        $categoryName = $category->fetchAll($category->attributes());
        return $this->render('product', [
            'model' => $result,
            'category' => $categoryName,
        ]);
        // return Application::$app->controller->render('profile');
    }

    public function handleProduct(Request $request, Response $response)
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        $dataGender = $requestData['idGender'] ?? [];
        $dataCategoryId = $requestData['idCategoryValue'] ?? [];
        // var_dump($dataGender);
        $product = new Product();
        if ($request->isPost()) {
            $render = $product->fetchFillter($dataGender, intval($dataCategoryId));
            foreach ($render as $key => $value) {
?>
                <a href="/product-detail?id=<?php echo $value['product_id'] ?>">
                    <div class="col pb-4 mb-2">
                        <div class="card" style="width: 100%; border: none;">
                            <img src="<?php echo $value['product_image'] ?>" class="card-img-top" alt="...">
                            <div class="product-description mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start">
                                        <h6 style="color: #E22A19;" class="fw-bold">Bản giới hạn</h6>
                                        <h5 style="color: black; margin-bottom: 4px;" class="fw-4"><?php echo $value['product_name'] ?></h5>
                                        <span style="color: #707072; margin-bottom: 8px;"><?php echo $value['description'] ?></span>
                                        <span><?php echo $value['price'] ?>₫</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
<?php
            }
        }
    }

    public function productDetail(Request $request)
    {
        $prductDetail = new Product();
        $orderItems = new OrderItem();
        $result = $prductDetail->findOne(['product_id' => $_GET['id']]);
        // $orderItem = $orderItems->findOne(['product_id' => $_GET['id']]);
        $order = $orderItems->findAll($_GET['id']);
        $message = new Comment();
        $mess = $message->fetchArr(['user_user_id' => Application::$app->userExists->id, 'product_id' => $_GET['id']]);
        return $this->render('productDetail', [
            'model' => $result,
            'orderItem' => $order,
            'message' => $mess
        ]);
    }

    public function handleProductDetail(Request $request, Response $response)
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        $checkCommentPost = $requestData['message'] ?? false;
        $content = $requestData['content'] ?? '';
        $id = intval($requestData['id']) ?? false;
        $jsonData = [];

        if ($checkCommentPost) {
            $comment = new Comment();
            if ($request->isPost()) {
                $user_id = Application::$app->userExists->id;
                $comment->loadData($request->getBody());
                $comment->user_user_id = $user_id;
                $comment->product_id = $id;
                $comment->message = $content;
                $comment->save();

                $result = $comment->fetchArr(['user_user_id' => $user_id, 'product_id' => $_GET['id']]);
                foreach ($result as $value) {
                    $messageData = [
                        'message' => $value['message'],
                    ];
                    $jsonData[] = $messageData;
                }
                // Thêm mảng dữ liệu của mỗi sản phẩm vào mảng chính
                $jsonString = json_encode($jsonData);
                // In chuỗi JSON hoặc truyền nó vào JavaScript để sử dụng
                echo $jsonString;
                exit;
            }
        }

        $idProduct = intval($requestData['id']);
        $quantity = intval($requestData['quantity']);
        // Rest of your PHP code...

        // var_dump($quantity, $idProduct);
        $addToCart = new Cart($quantity, $idProduct);
        if ($request->isPost()) {
            if ($addToCart->checkUser($response) && $addToCart->saveCartXhr($idProduct, $addToCart->user_user_id)) {
                Application::$app->session->setFlash('addToCart', 'Thêm vào giỏ hàng !!!');
            }
        }
    }
}
