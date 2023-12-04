<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\Response;

class Cart extends DbModel
{
    // thuộc tính của object register model trùng với key trong loadData($data)
    public $product_product_id;
    public $user_user_id;
    public $quantity;

    public function __construct(?string $quantity, ?string $idProduct)
    {
        $this->product_product_id = $idProduct;
        $this->user_user_id = Application::$app->userExists->id ?? null;
        $this->quantity = $quantity;
    }

    public function tableName(): string
    {
        return 'cart';
    }

    public function primaryKey(): string
    {
        return 'cart_id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'product_product_id', 'user_user_id', 'quantity',
        ];
    }

    // get NAME TABLE ID FOREIGN KEY
    public function getUserName(): string
    {
        return 'product_product_id, user_user_id';
    }

    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        // self::class lay class 
        return [
            // attribute so luong size may` validate
            // 'product_name' => [self::RULE_REQUIRE],
            // 'description' => [self::RULE_REQUIRE],
            // 'price' => [self::RULE_REQUIRE],
        ];
    }
    
    public function checkUser($res)
    {
        if ($this->user_user_id === null) {
            echo json_encode(['redirect' => '/login']);
            exit;
        }
        return true;
    }
}