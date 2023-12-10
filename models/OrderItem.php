<?php 
namespace app\models;

use app\core\DbModel;

class OrderItem extends DbModel
{
    public $orders_id;
    public $product_id;
    public $quantity;
    public $price_order;
    
    public function tableName(): string
    {
        return 'order_items';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'orders_id', 'product_id', 'quantity', 'price_order',
        ];
    }

    // get NAME TABLE ID FOREIGN KEY
    public function getUserName(): string
    {
        return '';
    }

    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [];
    }
}