<?php
namespace app\core\form;
use app\core\Model;
class Field
{
    public Model $model;
    public string $attribute;
    public function __construct(Model $model, $attribute) {
        $this->model = $model;
        $this->attribute = $attribute;
    }
}