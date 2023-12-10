<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\Response;

class Comment extends DbModel
{
    public $user_user_id;
    public $product_id;
    public string $message = '';

    public function tableName(): string
    {
        return 'comment';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'user_user_id', 'product_id', 'message'
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