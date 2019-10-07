<?php

namespace bistro\entities\Food;

use yii\db\ActiveRecord;

/**
 * Class Drink
 *
 * @property integer $id
 * @property string $name
 */
class Drink extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%bistro_drink}}';
    }
    public static function create($name)
    {
        $drink = new static();
        $drink->name = $name;
    }

}
