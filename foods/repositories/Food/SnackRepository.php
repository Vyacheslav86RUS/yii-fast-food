<?php

namespace foods\repositories\Food;

use foods\entities\Food\Snack;
use foods\repositories\NotFoundException;

class SnackRepository
{
    public function get($id)
    {
        if (!$snack = Snack::findOne(['id' => $id])) {
            throw new NotFoundException('Закуска не найдена.');
        }

        return $snack;
    }

    public function save(Snack $snack)
    {
        if (!$snack->save()) {
            throw new NotFoundException('Ошибка сохранения закуски.');
        }
    }

    public function remove(Snack $snack)
    {
        if (!$snack->delete()) {
            throw new NotFoundException('Ошибка удаления закуски.');
        }
    }
}
