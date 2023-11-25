<?php 
namespace app\models;

use app\core\Application;
use app\core\Model;

class AddCategory extends Model
// LOGIN MAIN USER AND ADMIN
{
    public string $name = '';

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRE]
        ];
    }

    public function checkForm()
    {
        $category = new Category();
        $categoryQuery = $category->findOne(['name' => $this->name]);
        
        if ($categoryQuery) {
            $this->addError('name', 'Name was exists before');
            return false;
        }
    }
}