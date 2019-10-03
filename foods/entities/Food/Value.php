<?php

namespace foods\entities\Food;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property float $value
 * @property Price $price_id
 */
class Value extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_value}}';
    }
}