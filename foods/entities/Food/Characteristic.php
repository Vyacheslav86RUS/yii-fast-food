<?php

namespace foods\entities\Food;

use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 */
class Characteristic extends ActiveRecord
{
    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';

    public $variants;

    public static function create($name, $type, $required, $default, array $variants, $sort)
    {
        $object = new static();
        $object->name = $name;
        $object->type = $type;
        $object->required = $required;
        $object->default = $default;
        $object->variants = $variants;
        $object->sort = $sort;

        return $object;
    }

    public function edit($name, $type, $required, $default, array $variants, $sort)
    {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
        $this->variants = $variants;
        $this->sort = $sort;
    }

    public function isSelect()
    {
        return count($this->variants) > 0;
    }

    public static function tableName()
    {
        return '{{%food_characteristics}}';
    }

    public function afterFind()
    {
        $this->variants = Json::decode($this->getAttribute('variants_json'));
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->setAttributes('variants_json', Json::encode($this->variants));
        return parent::beforeSave($insert);
    }
}
