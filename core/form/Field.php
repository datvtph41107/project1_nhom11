<?php 
namespace app\core\form;

use app\core\Model;

class Field 
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(\app\core\Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf(
            '<div class="form-outline">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control form-control-lg %s" />
                <div class="invalid-feedback">
                    %s
                </div>
            </div>'
        , 
            $this->attribute, 
            $this->type,
            $this->attribute, 
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute),
        // {$this->attribute} => $this->firstname lay gia tri truoc do
        // model-> lay doi tuong attribute (firstname) trong class model
        );
    }

    public function passwordFieldType()
    {
        $this->type = self::TYPE_PASSWORD;
        // trả về chính CLASS FIELD
        // Mục đích khi gọi hàm này sẽ khởi tạo hàm mới và trả về dữ liệu của hàm mới
        return $this;
    }
}