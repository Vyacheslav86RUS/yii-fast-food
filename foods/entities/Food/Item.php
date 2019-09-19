<?php

namespace foods\entities\Food;

use foods\behaviors\MetaBehavior;
use foods\entities\Meta;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Item extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta)
    {
        $item = new static();
        $item->name = $name;
        $item->slug = $slug;
        $item->meta = $meta;

        return $item;
    }

    public function edit($name, $slug, Meta $meta)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public static function tableName()
    {
        return '{{%food_items}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => MetaBehavior::class,
                'attribute' => 'meta',
                'jsonAttribute' => 'meta_json',
            ]
        ];
    }

}
