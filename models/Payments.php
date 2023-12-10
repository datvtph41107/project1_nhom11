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
    public $created_by;
    public $session_id;
    public $session_uri;

    public function __construct(?float $total,?int $order_detail_id,?string $type,?int $created_by, ?string $session_id, ?string $session_uri)
    {
        $this->amount = $total;
        $this->status = self::STATUS_PENDING;
        $this->order_order_id = $order_detail_id;
        $this->type = $type;
        $this->created_by = $created_by;
        $this->session_id = $session_id;
        $this->session_uri = $session_uri;
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
            'amount', 'status', 'type', 'order_order_id', 'created_by', 'session_id', 'session_uri'
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