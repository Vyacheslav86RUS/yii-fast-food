<?php

namespace foods\entities\Food;

use foods\behaviors\MetaBehavior;
use foods\entities\Meta;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property Meta $meta
 */
class Pizza extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_pizza}}';
    }

    public static function create($name, Meta $meta)
    {
        $pizza = static();
        $pizza->name = $name;
        $pizza->meta = $meta;

        return $pizza;
    }

    public function edit($name, Meta $meta)
    {
        $this->name = $name;
        $this->meta = $meta;
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
