<?php

namespace foods\entities\Food;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $path
 */
class Image extends ActiveRecord
{
    public static function tableName()
    {
        return  '{{%food_img}}';
    }
}