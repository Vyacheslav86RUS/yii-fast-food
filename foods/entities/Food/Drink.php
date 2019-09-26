<?php

namespace foods\entities\Food;

use foods\behaviors\AttachModelAttributeBehavior;
use foods\behaviors\MetaBehavior;
use foods\entities\Meta;
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
            'AttachCategoryBehavior' => [
                'class' => AttachModelAttributeBehavior::class,
                'attachAttribute' => 'category_id'
            ],
            'AttachImageBehavior' => [
                'class' => AttachModelAttributeBehavior::class,
                'attachAttribute' => 'img_id'
            ],
            'AttachValueBehavior' => [
                'class' => AttachModelAttributeBehavior::class,
                'attachAttribute' => 'value_id'
            ],
            'MetaBehavior' => [
                'class' => MetaBehavior::class,
                'attribute' => 'meta',
                'jsonAttribute' => 'meta_json',
            ]
        ];
    }

//    public function attachCategory(Drink $drink, Category $category)
//    {
//        $drink->category_id = $category->id;
//
//        return $drink;
//    }
//
//    public function attachImage(Drink $drink, Image $image)
//    {
//        $drink->img_id = $image->id;
//
//        return $drink;
//    }
//
//    public function attachValue(Drink $drink, Value $value)
//    {
//        $drink->value_id = $value->id;
//
//        return $drink;
//    }

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
