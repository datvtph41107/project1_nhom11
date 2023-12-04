<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\Category;
use app\models\OrderItem;
use app\models\Orders;
use app\models\Payments;
use app\models\Product;

class CheckoutController extends Controller
{
    public function checkout(Request $request, Response $response)
    {
        $order = new OrderItem();
        $product = new Product();
        $category = new Category();
        $infor = $order->findOne(['user_user_id' => $order->user_user_id]);
        $lineItems = [];
        $cart = new Cart($quantity = null, $idProduct = null);
        
        if ($request->isPost()) {
            $order->loadData($request->getBody());
            $cartItems = $cart->fetchQuery(["product" => [$product->primaryKey(), $product->getUserName()]], ["category" => $category->primaryKey()], intval($cart->user_user_id));
            foreach ($cartItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['product_name'],
                            // 'images' => $item['product_image'],
                        ],
                        'unit_amount' => intval($item['price']) * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }
            $stripe = new \Stripe\StripeClient('sk_test_51OJTyoKsc7NGojVfMWRHeGPjgySMpE853D9gkXOnaXjFVLnx5ecowK2YtO0geNLCOv6D3fJhaskN2UCDvT5cwYti00Kc8gbOpW');

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => 'http://localhost:8080/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost:8080/checkout/failure',
            ]);
            
            if ($order->validateModel() && $order->save()) {
                return $response->redirect($checkout_session->url);
            }
            return $response->redirect($checkout_session->url);
        }
    }
    
    public function success(Request $request, Response $response)
    {
        $session_id = $_GET['session_id'];
        if (!$session_id) {
            return $this->failure();
        }
        $orderDetail = new OrderItem();
        $order_id = $orderDetail->findOne(['user_user_id' => $orderDetail->user_user_id]);
        $cart = new Cart($quantity = null, $idProduct = null);
        $totalPrice = $cart->fetchTotalPrice(intval($cart->user_user_id));
        $totalPrice = str_replace(',', '.', $totalPrice);
        $formattedTotalPrice = number_format((float)$totalPrice, 3, '.', '.');
        // $totalPrice = number_format((float)$totalPrice, 0, '.', '.');
        $orders = new Orders($formattedTotalPrice, 'unpaid');
        $payments = new Payments($formattedTotalPrice, 'unpaid', $order_id->order_id, 'cc');

        $orders->save();
        $payments->save();
        Application::$app->controller->setLayout('paymentLayouts');
        return $this->render('payment');
    }

    public function failure()
    {
        die('failure');
    }

    public function order()
    {
        $order = new OrderItem();
        $product = new Product();
        $category = new Category();
        $cart = new Cart($quantity = null, $idProduct = null);
        $cartItem = $cart->fetchQuery(["product" => [$product->primaryKey(), $product->getUserName()]], ["category" => $category->primaryKey()], intval($cart->user_user_id));
        $totalPrice = $cart->fetchTotalPrice(intval($cart->user_user_id));

        Application::$app->controller->setLayout('orderLayout');
        $infor = $order->findOne(['user_user_id' => $order->user_user_id]);
        
        if ($infor) {
            return $this->render('order', [
                'model' => $order,
                'cart' => $cartItem,
                'total' => $totalPrice,
                'infor' => $infor
            ]);
        }
        return $this->render(
            'order',
            [
                'model' => $order,
                'cart' => $cartItem,
                'total' => $totalPrice,
            ]
        );
    }

    public function orderUpdate(Request $request, Response $response)
    {
        $order = new OrderItem();
        $infor = $order->findOne(['user_user_id' => $order->user_user_id]);
        if ($request->isPost()) {
            $order->loadData($request->getBody());
            if ($order->validateModel() && $order->update(["user_user_id" => $order->user_user_id])) {
                return $response->redirect('/checkout');
            }
        }
    }
}
?>