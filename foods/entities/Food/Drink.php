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
class Drink extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_drink}}';
    }
    
    public static function create($name, Meta $meta)
    {
        $drink = new static();
        $drink->name = $name;
        $drink->meta = $meta;

        return $drink;
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
