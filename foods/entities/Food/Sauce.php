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
class Sauce extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_sauce}}';
    }

    public static function create($name, Meta $meta)
    {
        $sauce = new static();
        $sauce->name = $name;
        $sauce->meta = $meta;

        return $sauce;
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

//    public function attachCategory(Sauce $sauce, Category $category)
//    {
//        $sauce->category_id = $category->id;
//
//        return $sauce;
//    }
//
//    public function attachImage(Sauce $sauce, Image $image)
//    {
//        $sauce->img_id = $image->id;
//
//        return $sauce;
//    }
//
//    public function attachValue(Sauce $sauce, Value $value)
//    {
//        $sauce->value_id = $value->id;
//
//        return $sauce;
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
