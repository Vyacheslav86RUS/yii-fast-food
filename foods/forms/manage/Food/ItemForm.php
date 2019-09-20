<?php

namespace foods\forms\manage\Food;

use foods\entities\Food\Item;
use foods\forms\CompositeForm;
use foods\forms\manage\MetaForm;
use foods\validators\SlugValidator;

/**
 * @property MetaForm $meta
 */
class ItemForm extends CompositeForm
{
    public $name;
    public $slug;

    private $_item;

    public function __construct(Item $item = null, $config = [])
    {
        if ($item) {
            $this->name = $item->name;
            $this->slug = $item->slug;
            $this->meta = new MetaForm($item->meta);
            $this->_item = $item;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Item::class, 'filter' => $this->_item ? ['<>', 'id', $this->_item->id] : null]
        ];
    }

    protected function internalForms()
    {
        return ['meta'];
    }
}
