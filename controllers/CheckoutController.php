<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exception\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\Category;
use app\models\OrderDetail;
use app\models\OrderItem;
use app\models\Orders;
use app\models\Payments;
use app\models\Product;

class CheckoutController extends Controller
{
    public function checkout(Request $request, Response $response)
    {
        $order = new OrderDetail();
        $product = new Product();
        $category = new Category();
        $cart = new Cart($quantity = null, $idProduct = null);

        $orderItems = [];
        $lineItems = [];
        $totalPrice = $cart->fetchTotalPrice(intval($cart->user_user_id));
        $totalPrice = (float)$totalPrice;
        $order_id = $order->findOne(['user_user_id' => $order->user_user_id]);

        if ($request->isPost()) {
            $order->loadData($request->getBody());
            $order->save();
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
                $orderItems[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_order' => $item['price']
                ];
            }
            $stripe = new \Stripe\StripeClient('sk_test_51OJTyoKsc7NGojVfMWRHeGPjgySMpE853D9gkXOnaXjFVLnx5ecowK2YtO0geNLCOv6D3fJhaskN2UCDvT5cwYti00Kc8gbOpW');

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => 'http://localhost:8080/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost:8080/checkout/failure',
            ]);
            $orders = new Orders($totalPrice, $order->user_user_id);
            $orders->save();
            $lastInsertedId = Application::$app->db->pdo->lastInsertId();
            // var_dump($lastInsertedId);
            $orderItemModel = new OrderItem();
            foreach ($orderItems as $orderItem) {
                $orderItemModel->orders_id = $lastInsertedId;
                $orderItemModel->product_id = $orderItem['product_id'];
                $orderItemModel->quantity = $orderItem['quantity'];
                $orderItemModel->price_order = $orderItem['price_order'];
                $orderItemModel->save();
            }

            $payments = new Payments($totalPrice, $lastInsertedId, 'cc', $order->user_user_id, $checkout_session->id, $checkout_session->url);
            $payments->session_id = $checkout_session->id;
            $parts = explode("/pay/", $checkout_session->url);
            // Lấy phần tử thứ hai của mảng (nếu tồn tại)
            if (isset($parts[1])) {
                $result = $parts[1];
                $payments->session_uri = $result;
            } else {
                echo "Không tìm thấy phần sau /pay/";
            }
            $payments->save();

            if ($order->validateModel() && $order->save()) {
                return $response->redirect($checkout_session->url);
            }
            return $response->redirect($checkout_session->url);
        }
    }

    public function success(Request $request, Response $response)
    {
        $cart = new Cart($quantity = null, $idProduct = null);
        $cart->delete(["user_user_id" => $cart->user_user_id]);
        $payment = new Payments($totalPrice = null, $order_id = null, 'cc', $order = null, $checkout_session = null, $checkout_uri = null);

        $session_id = $_GET['session_id'];
        if (!$session_id) {
            return $this->failure();
        }
        $paymentQuery = $payment->selectQuery($session_id);
        if (!$paymentQuery) {
            throw new NotFoundException();
        }
        if ($paymentQuery->status === $payment::STATUS_PENDING) {
            $this->updateOrderAndSession($paymentQuery);
        }
        Application::$app->controller->setLayout('paymentLayouts');
        return $this->render('payment');
    }

    public function failure()
    {
        // echo '123';
        Application::$app->session->setFlash('paymentFailed', 'Giao dịch không thành công');
        Application::$app->controller->setLayout('paymentLayouts');
        return $this->render('payment');
    }

    public function order()
    {
        $order = new OrderDetail();
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
        $order = new OrderDetail();
        $infor = $order->findOne(['user_user_id' => $order->user_user_id]);
        if ($request->isPost()) {
            $order->loadData($request->getBody());
            if ($order->validateModel() && $order->update(["user_user_id" => $order->user_user_id])) {
                return $response->redirect('/checkout');
            }
        }
    }

    public function updateOrderAndSession($payment)
    {
        $paymentModel = new Payments($totalPrice = $payment->amount, $order_id = $payment->order_order_id, 'cc', $createdby = $payment->created_by, $checkout_session = $payment->session_id, $checkout = $payment->session_uri);
        $paymentModel->status = $paymentModel::STATUS_PAID;
        $paymentModel->updateCase(['session_id' => $payment->session_id]);

        $orderModel = new Orders($total = $payment->amount, $createdby = $payment->created_by);
        $orderModel->status = $orderModel::STATUS_PAID;
        $orderModel->updateCase(['id' => $payment->order_order_id]);
    }
}
