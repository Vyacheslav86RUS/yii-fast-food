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
class Snack extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%food_snack}}';
    }

    public static function create($name, Meta $meta)
    {
        $snack = new static();
        $snack->name = $name;
        $snack->meta = $meta;

        return $snack;
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
            ],
//            'ReferencesCategoryBehavior' => [
//                'class' => ReferencesBehavior::class,
//                'refModel' => Category::class,
//                'refAttribute' => 'id',
//                'ownerAttribute' => 'category_id'
//            ],
//            'ReferencesImageBehavior' => [
//                'class' => ReferencesBehavior::class,
//                'refModel' => Image::class,
//                //'refAttribute' => 'id',
//                'ownerAttribute' => 'img_id'
//            ],
//            'ReferencesValueBehavior' => [
//                'class' => ReferencesBehavior::class,
//                'refModel' => Value::class,
//                //'refAttribute' => 'id',
//                'ownerAttribute' => 'value_id'
//            ]
        ];
    }

//    public function attachCategory(Snack $snack, Category $category)
//    {
//        $snack->category_id = $category->id;
//
//        return $snack;
//    }
//
//    public function attachImage(Snack $snack, Image $image)
//    {
//        $snack->img_id = $image->id;
//
//        return $snack;
//    }
//
//    public function attachValue(Snack $snack, Value $value)
//    {
//        $snack->value_id = $value->id;
//
//        return $snack;
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
