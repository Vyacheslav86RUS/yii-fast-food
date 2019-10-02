<?php

namespace foods\entities\Food;

use foods\behaviors\AttachModelAttributeBehavior;
use foods\behaviors\MetaBehavior;
use foods\entities\Meta;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property Meta $meta
 * @property integer $category_id
 * @property integer $img_id
 * @property integer $value_id
 *
 * @property Category $category
 * @property Image $img
 * @property Value $value
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
            'MetaBehavior' => [
                'class' => MetaBehavior::class,
                'attribute' => 'meta',
                'jsonAttribute' => 'meta_json',
            ],
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['category', 'img', 'value']
            ]
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['category_id' => 'id']);
    }

    public function getImg()
    {
        return $this->hasOne(Image::class, ['img_id' => 'id']);
    }

    public function getValue()
    {
        return $this->hasOne(Value::class, ['value_id' => 'id']);
    }
}
