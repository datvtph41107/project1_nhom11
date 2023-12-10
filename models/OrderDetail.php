<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\core\Response;

class OrderDetail extends DbModel
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID= 'paid';
    public const STATUS_FAILED= 'failed';
    // thuộc tính của object register model trùng với key trong loadData($data)
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $province = '';
    public string $district = '';
    public string $ward = '';
    public $user_user_id;

    public function __construct()
    {   
        $this->user_user_id = Application::$app->userExists->id;
    }

    public function tableName(): string
    {
        return 'order_details';
    }

    public function primaryKey(): string
    {
        return 'order_id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'firstname', 'lastname', 'email', 'phone', 'address', 'province', 'district', 'ward', 'user_user_id'
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
        return [
            'firstname' => [self::RULE_REQUIRE],
            'lastname' => [self::RULE_REQUIRE],
            'email' => [self::RULE_REQUIRE, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'phone' => [self::RULE_REQUIRE, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10], [self::RULE_UNIQUE, 'class' => self::class]],
            'address' => [self::RULE_REQUIRE],
            'province' => [self::RULE_REQUIRE],
            'district' => [self::RULE_REQUIRE],
        ];
    }
}