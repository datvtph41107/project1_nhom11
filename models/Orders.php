<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\Response;
use DateTime;

class Orders extends DbModel
{
    public const STATUS_UNPAID = 'unpaid';
    public const STATUS_PAID= 'paid';
    public const STATUS_COMPLETE= 'completed';
    // thuộc tính của object register model trùng với key trong loadData($data)
    public $total_price;
    public string $status = '';
    public $created_by;

    public function __construct( $total = null, $created_by = null)
    {
        $this->total_price = $total;
        $this->status = self::STATUS_UNPAID;
        $this->created_by = $created_by;
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
            'total_price', 'status', 'created_by',
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