<?php


namespace foods\forms\manage\Food;

use foods\entities\Food\Drink;
use foods\forms\CompositeForm;
use foods\forms\manage\MetaForm;

/**
 * @property MetaForm $meta
 * @property CategoryForm $category
 * @property ImgForm $img
 * @property ValueForm $value
 */
class DrinkForm extends CompositeForm
{
    public $name;

    private $drink;

    public function __construct(Drink $drink = null, $config = [])
    {
        if ($drink) {

        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    protected function internalForms()
    {
        return ['meta', 'category', 'img'];
    }
}
