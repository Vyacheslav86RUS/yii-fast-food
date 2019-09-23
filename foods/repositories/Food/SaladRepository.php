<?php

namespace foods\repositories\Food;

use foods\entities\Food\Salad;
use foods\repositories\NotFoundException;

class SaladRepository
{
    public function get($id)
    {
        if (!$salad = Salad::findOne(['id' => $id])) {
            throw new NotFoundException('Салат не найден.');
        }

        return $salad;
    }

    public function save(Salad $salad)
    {
        if (!$salad->save()) {
            throw new NotFoundException('Ошибка сохранения салата.');
        }
    }

    public function remove(Salad $salad)
    {
        if (!$salad->delete()) {
            throw new NotFoundException('Ошибка удаления салата.');
        }
    }
}
