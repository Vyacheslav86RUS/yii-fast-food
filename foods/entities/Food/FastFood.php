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
class FastFood extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%fast_food}}';
    }

    public static function create($name, Meta $meta)
    {
        $fastFood = new static();
        $fastFood->name = $name;
        $fastFood->meta = $meta;

        return $fastFood;
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

//    public function attachCategory(FastFood $fastFood, Category $category)
//    {
//        $fastFood->category_id = $category->id;
//
//        return $fastFood;
//    }
//
//    public function attachImage(FastFood $fastFood, Image $image)
//    {
//        $fastFood->img_id = $image->id;
//
//        return $fastFood;
//    }
//
//    public function attachValue(FastFood $fastFood, Value $value)
//    {
//        $fastFood->value_id = $value->id;
//
//        return $fastFood;
//    }

    public function edit($name, Meta $meta)
    {
        $this->name = $name;
        $this->meta = $meta;
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