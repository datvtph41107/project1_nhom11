<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\OrderItem;
use app\models\Orders;
use app\models\Payments;

class PaymentController extends Controller
{
    public function paymentHistory(Request $request, Response $response)
    {
        $order = new Orders($total = null, $created_by  = null);
        $user_id = Application::$app->userExists->id;
        $result = $order->fetchOne($user_id);
        return $this->render('ordersItem', [
            'model' => $result
        ]);
    }

    public function paymentDetail(Request $request, Response $response)
    {
        $orderItems = new OrderItem();
        $user_id = Application::$app->userExists->id;
        $id = $_GET['id'];
        $orderItem = $orderItems->selectMuch($user_id, $id);
        $payment = new Payments($totalPrice = null, $order_id = null, 'cc', $order = null, $checkout_session = null, $checkout_uri = null);
        $result = $payment->fetch(["order_order_id" => $orderItem[0]['id']]);
        return $this->render('paymentDetail', [
            'model' => $orderItem,
            'payment' => $result,
        ]);
    }

    public function failure()
    {
        die('failure');
    }
}
?>