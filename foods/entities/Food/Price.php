<?php

namespace foods\entities\Food;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property float $price
 * @property Value $value
 */
class Price extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%food_price}}';
    }
}
