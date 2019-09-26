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

//    public function attachCategory(Salad $salad, Category $category)
//    {
//        $salad->category_id = $category->id;
//
//        return $salad;
//    }
//
//    public function attachImage(Salad $salad, Image $image)
//    {
//        $salad->img_id = $image->id;
//
//        return $salad;
//    }
//
//    public function attachValue(Salad $salad, Value $value)
//    {
//        $salad->value_id = $value->id;
//
//        return $salad;
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
