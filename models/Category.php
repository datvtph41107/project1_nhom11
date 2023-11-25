<?php 
namespace app\models;

use app\core\DbModel;

class Category extends DbModel
{
    // thuộc tính của object register model trùng với key trong loadData($data)
    public string $name = '';

    public function tableName(): string
    {
        return 'category';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return [
            'name'
        ];
    }

    public function getUserName(): string
    {
        return $this->name;
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
            'name' => [self::RULE_REQUIRE],
        ];
    }
}