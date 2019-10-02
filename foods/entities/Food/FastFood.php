<?php

namespace foods\entities\Food;

use foods\behaviors\AttachModelAttributeBehavior;
use foods\behaviors\MetaBehavior;
use foods\behaviors\ReferencesBehavior;
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
//            'AttachCategoryBehavior' => [
//                'class' => AttachModelAttributeBehavior::class,
//                'attachAttribute' => 'category_id'
//            ],
//            'AttachImageBehavior' => [
//                'class' => AttachModelAttributeBehavior::class,
//                'attachAttribute' => 'img_id'
//            ],
//            'AttachValueBehavior' => [
//                'class' => AttachModelAttributeBehavior::class,
//                'attachAttribute' => 'value_id'
//            ],
            'MetaBehavior' => [
                'class' => MetaBehavior::class,
                'attribute' => 'meta',
                'jsonAttribute' => 'meta_json',
            ],
//            'ReferencesCategoryBehavior' => [
//                'class' => ReferencesBehavior::class,
//                'refModel' => Category::class,
//                //'refAttribute' => 'id',
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
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['category', 'img', 'value']
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

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

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
