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
class Sauce extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_sauce}}';
    }

    public static function create($name, Meta $meta)
    {
        $sauce = new static();
        $sauce->name = $name;
        $sauce->meta = $meta;

        return $sauce;
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
