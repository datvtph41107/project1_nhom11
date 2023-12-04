<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\Response;

class Orders extends DbModel
{
    public const STATUS_UNPAID = 'unpaid';
    public const STATUS_PAID= 'paid';
    public const STATUS_COMPLETE= 'completed';
    // thuộc tính của object register model trùng với key trong loadData($data)
    public $total_price;
    public string $status = '';

    public function __construct($total, $status)
    {
        $this->total_price = $total;
        $this->status = $status;
    }

    public function tableName(): string
    {
        return 'orders';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'total_price', 'status'
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
        return [
            
        ];
    }
}