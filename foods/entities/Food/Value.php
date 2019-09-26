<?php

namespace foods\entities\Food;

use yii\db\ActiveRecord;

class Value extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_value}}';
    }
}