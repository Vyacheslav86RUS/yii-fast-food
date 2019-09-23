<?php


namespace foods\repositories\Food;

use foods\entities\Food\Drink;
use foods\repositories\NotFoundException;

class DrinkRepository
{
    public function get($id)
    {
        if (!$drink = Drink::findOne(['id' => $id])) {
            throw new NotFoundException('Напиток не найден.');
        }

        return $drink;
    }

    public function save(Drink $drink)
    {
        if (!$drink->save()) {
            throw new NotFoundException('Ошибка сохранения напитка.');
        }
    }

    public function remove(Drink $drink)
    {
        if (!$drink->delete()) {
            throw new NotFoundException('Ошибка удаления напитка.');
        }
    }
}
