<?php 
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;

class Product extends DbModel
{
    // thuộc tính của object register model trùng với key trong loadData($data)
    public string $product_name = '';
    public string $description = '';
    public string $price = '';
    public string $product_image = '';
    public string $status = '';
    public string $gender = '';
    public $category_category_id;

    public function tableName(): string
    {
        return 'product';
    }

    public function primaryKey(): string
    {
        return 'product_id';
    }

    // Để lấy tên bảng và giá trị
    public function attributes(): array
    {
        return [
            'product_name', 'description', 'price', 'status', 'gender', 'product_image', 'category_category_id'
        ];
    }

    public function getUserName(): string
    {
        return 'category_category_id';
    }

    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        // self::class lay class 
        return [
            // attribute
            'product_name' => [self::RULE_REQUIRE],
            'description' => [self::RULE_REQUIRE],
            'price' => [self::RULE_REQUIRE],
        ];
    }

    public function CheckForm()
    {
        if (empty($this->product_image)) {
            Application::$app->session->setFlash('fail', 'Hãy nhập đủ thông tin');
            return false;
        }
        if ($this->category_category_id === 0) {
            Application::$app->session->setFlash('fail', 'Hãy nhập đủ thông tin');
            return false;
        }

        // var_dump($userQuery);
        return true;
    }
}