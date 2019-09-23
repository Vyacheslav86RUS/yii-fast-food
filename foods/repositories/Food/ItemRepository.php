<?php

namespace foods\repositories\Food;

use foods\entities\Food\Item;
use foods\repositories\NotFoundException;

class ItemRepository
{
    public function get($id)
    {
        if (!$item = Item::findOne(['id' => $id])) {
            throw new NotFoundException('Предмет не найден.');
        }
        
        return $item;
    }

    public function save(Item $item)
    {
        if (!$item->save()) {
            throw new \RuntimeException('Ошибка сохранения предмета.');
        }
    }

    public function remove(Item $item)
    {
        if (!$item->delete()) {
            throw new \RuntimeException('Ошибка удаления предмета.');
        }
    }
}
