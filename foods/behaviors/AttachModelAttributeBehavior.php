<?php

namespace foods\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class AttachModelAttributeBehavior extends Behavior
{
    public $attachAttribute = 'id';

    public function attachModelAttribute(ActiveRecord $model)
    {
        $this->owner->{$this->attachAttribute} = $model->id;

        return $this->owner;
    }
}
