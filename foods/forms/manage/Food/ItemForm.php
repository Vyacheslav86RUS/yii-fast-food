<?php

namespace foods\forms\manage\Food;

use foods\entities\Food\Item;
use foods\forms\manage\MetaForm;
use yii\base\Model;

class ItemForm extends Model
{
    public $name;
    public $slug;

    private $_item;
    private $_meta;

    public function __construct(Item $item = null, $config = [])
    {
        if ($item) {
            $this->name = $item->name;
            $this->slug = $item->slug;
            $this->_meta = new MetaForm($item->meta);
            $this->_item = $item;
        } else {
            $this->_meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function load($data, $formName = null)
    {
        $self = parent::load($data, $formName);
        $meta = $this->_meta->load($data, $formName !== '' ? 'meta' : null);

        return $self && $meta;
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern' => '/^[a-z0-9_-]+$/s'],
            [['name', 'slug'], 'unique', 'targetClass' => Item::class, 'filter' => $this->_item ? ['<>', 'id', $this->_item->id] : null]
        ];
    }
}
