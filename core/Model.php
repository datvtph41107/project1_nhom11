<?php
namespace app\core;

abstract class Model 
// class chung cho phan models
{
    public const RULE_REQUIRE = 'require';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public array $errors = [];
    
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            // kiểm tra thuộc tính của object registerModel
            if (property_exists($this, $key)) {
                // $this->{$key} là thuộc tính bên registerModel
                $this->{$key} = $value;
            }
        }
    }

    abstract function rules(): array;
    
    public function validateModel()
    {
        foreach ($this->rules() as $attribute => $rules) {
        // echo '<pre>';
        // var_dump($this->rules());
        // echo '</pre>';
            // gán gtri vd: firstname vao $value
            $value = $this->{$attribute};
            // aray 2 rules la value
            foreach ($rules as $rule) {
                $ruleName = $rule;
                // echo '<pre>';
                // var_dump( $rule);
                // echo '</pre>';
                if (!is_string($ruleName)) {
                    // self::RULE_REQUIRE
                    // [self::RULE_MIN, 'min' => 8]
                    // key trong mang la 0 va min   
                    $ruleName = $rule[0];
                    // $rulename để lấy tên của quy tắc
                    // self::RULE_MIN ,self::RULE_MAX
                }

                // Kiểm tra xem dữ liệu nhập vào có rống không
                if ($ruleName === self::RULE_REQUIRE && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRE);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    // $rule is [self::RULE_MIN, 'min' => 8]
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        // Cuối cùng, phương thức trả về true nếu không có lỗi nào được thêm vào mảng lỗi errors, ngược lại nó trả về false.
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        
        $message = $this->errorMessages()[$rule] ?? '';
        // $params have key => 0 or => min, max, match
     

        foreach ($params as $key => $value) {
        //        echo '<pre>';
        // var_dump($value);
        // echo '</pre>';
            // 2 dau {{}} de bo di 1 dau => {8} = > 8
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRE => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address', 
            self::RULE_MIN => 'Min length of this field must be {min}', 
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
        ];
    }

    // $attribute => firstname
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}