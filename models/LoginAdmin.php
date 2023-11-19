<?php 
namespace app\models;

use app\core\Application;
use app\core\Model;
use Exception;

class LoginAdmin extends Model
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
        if (!$user) {
            $this->addError('email', 'User does not exists with this email');
            return false;
        }
        if (!password_verify($this->password, $userQuery->password)) {
            $this->addError('password', 'password is incorrect');
            return false;
        }
        return Application::$app->login($userQuery);
    }

    public function CheckAdmin()
    {
        $user = new User();
        $userQuery = $user->findOne(['email' => $this->email]);
        if ($userQuery->role !== 1) {
            throw new Exception("Not Authorized", 1);
        }
        if (!$user) {
            $this->addError('email', 'User does not exists with this email');
            return false;
        }
        if (!password_verify($this->password, $userQuery->password)) {
            $this->addError('password', 'password is incorrect');
            return false;
        }
        return Application::$app->login($userQuery);
    }
}