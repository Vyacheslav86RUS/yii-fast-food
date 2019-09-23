<?php

namespace foods\repositories\Food;

use foods\entities\Food\Sauce;
use foods\repositories\NotFoundException;

class SauceRepository
{
    public function get($id)
    {
        if (!$sauce = Sauce::findOne(['id' => $id])) {
            throw new NotFoundException('Соус не найден.');
        }

        return $sauce;
    }

    public function save(Sauce $sauce)
    {
        if (!$sauce->save()) {
            throw new NotFoundException('Ошибка сохранения соуса.');
        }
    }

    public function remove(Sauce $sauce)
    {
        if (!$sauce->delete()) {
            throw new NotFoundException('Ошибка удаления соуса.');
        }
    }
}
