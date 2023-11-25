<?php 
namespace app\core\form;

use app\core\Model;

class Form 
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s" enctype="multipart/form-data">', $action, $method);
        // khoi tao de truy cap fied()
        return new Form();
    }
    
    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

    public function fieldUpdate(Model $model, $attribute, $arrayData)
    {
        // echo '<pre>';
        // var_dump($arrayData->$attribute);
        // echo '</pre>';
        // exit;
        return new FieldUpdate($model, $attribute, $arrayData->$attribute);
    }
}