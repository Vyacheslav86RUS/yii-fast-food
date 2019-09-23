<?php

namespace foods\repositories\Food;

use foods\entities\Food\Pizza;
use foods\repositories\NotFoundException;

class PizzaRepository
{
    public function get($id)
    {
        if (!$pizza = Pizza::findOne(['id' => $id])) {
            throw new NotFoundException('Пицца не найдена.');
        }

        return $pizza;
    }

    public function save(Pizza $pizza)
    {
        if (!$pizza->save()) {
            throw new NotFoundException('Ошибка сохранения пиццы.');
        }
    }

    public function remove(Pizza $pizza)
    {
        if (!$pizza->delete()) {
            throw new NotFoundException('Ошибка удаления пиццы.');
        }
    }
}
