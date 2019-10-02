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
