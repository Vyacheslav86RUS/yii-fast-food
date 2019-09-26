<?php

namespace foods\behaviors;

use yii\base\Behavior;

class ReferencesBehavior extends Behavior
{
    public $refModel;
    public $refAttribute = 'id';
    public $ownerAttribute;

    public function getRefModel()
    {
        $this->owner->hasOne($this->refModel, ["{$this->ownerAttribute}" => "{$this->refAttribute}"]);
    }
}
