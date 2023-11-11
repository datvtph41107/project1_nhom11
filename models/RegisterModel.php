<?php 
namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    // thuộc tính của object register model trùng với key trong loadData($data)
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function register()
    {
        echo 'creating user';
    }

    public function rules(): array
    {
        return [
            // attribute
            'firstname' => [self::RULE_REQUIRE],
            'lastname' => [self::RULE_REQUIRE],
            'email' => [self::RULE_REQUIRE, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRE, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRE, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}