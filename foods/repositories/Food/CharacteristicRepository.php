<?php

namespace foods\repositories\Food;

use foods\entities\Food\Characteristic;
use foods\repositories\NotFoundException;

class CharacteristicRepository
{
    public function get($id)
    {
        if (!$characteristic = Characteristic::findOne(['id' => $id])) {
            throw new NotFoundException('Характеристика не найдена.');
        }
    }

    public function save(Characteristic $characteristic)
    {
        if (!$characteristic->save()) {
            throw new NotFoundException('Ошибка сохранения характеристики.');
        }
    }

    public function remove(Characteristic $characteristic)
    {
        if (!$characteristic->delete()) {
            throw new NotFoundException('Ошибка удаления характеристики.');
        }
    }
}