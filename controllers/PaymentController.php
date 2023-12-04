<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Cart;
use app\models\OrderItem;
use app\models\Orders;
use app\models\Payments;

class PaymentController extends Controller
{
    public function paymentHistory(Request $request, Response $response)
    {
        
    }

    public function failure()
    {
        die('failure');
    }
}
?>