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
class Salad extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_salad}}';
    }

    public static function create($name, Meta $meta)
    {
        $salad = new static();
        $salad->name = $name;
        $salad->meta = $meta;

        return $salad;
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
