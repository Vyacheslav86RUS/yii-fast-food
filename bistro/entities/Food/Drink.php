<?php

namespace bistro\entities\Food;

use bistro\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class Drink
 *
 * @property integer $id
 * @property string $name
 * @property Meta $meta
 */
class Drink extends ActiveRecord
{
    public $meta;
    public static function tableName()
    {
        return '{{%bistro_drink}}';
    }
    public static function create($name, Meta $meta)
    {
        $drink = new static();
        $drink->name = $name;
        $drink->meta = $meta;

        return $drink;
    }

}
