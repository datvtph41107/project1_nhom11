<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\Response;

class Payments extends DbModel
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID= 'paid';
    public const STATUS_FAILED= 'failed';
    // thuộc tính của object register model trùng với key trong loadData($data)
    public $amount;
    public string $status = '';
    public string $type = '';
    public $order_order_id;

    public function __construct($total, $status, $order_detail_id, $type)
    {
        $this->amount = $total;
        $this->status = $status;
        $this->order_order_id = $order_detail_id;
        $this->type = $type;
    }

    public function tableName(): string
    {
        return 'payments';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'amount', 'status', 'type', 'order_order_id'
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