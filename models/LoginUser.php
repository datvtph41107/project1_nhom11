<?php 
namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginUser extends Model
// LOGIN MAIN USER AND ADMIN
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRE, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRE]
        ];
    }

    public function Checklogin()
    {
        $user = new User();
        $userQuery = $user->findOne(['email' => $this->email]);
        
        if (!$userQuery) {
            $this->addError('email', 'User does not exists with this email');
            return false;
        }
        if (!password_verify($this->password, $userQuery->password)) {
            $this->addError('password', 'password is incorrect');
            return false;
        }
        // var_dump($userQuery);
        return Application::$app->login($userQuery);
    }
}