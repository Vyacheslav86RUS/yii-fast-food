<?php

namespace foods\forms\manage\Food;

use foods\entities\Food\Value;
use foods\forms\CompositeForm;

/**
 * @property PriceForm $price
 */
class ValueForm extends CompositeForm
{
    public $name;
    public $value;

    private $_value;

    public function __construct(Value $value = null, $config = [])
    {
        if ($value) {
            $this->name = $value->name;
            $this->value = $value->value;
            $this->price = new PriceForm($value->price_id);
            $this->_value = $value;
        } else {
            $this->price = new PriceForm();
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['value'], 'double']
        ];
    }

    protected function internalForms()
    {
        return ['price'];
    }
}
