<?php

namespace foods\repositories\Food;

use foods\entities\Food\Tag;
use foods\repositories\NotFoundException;

class TagRepository
{
    public function get($id)
    {
        if (!$tag = Tag::findOne(['id' => $id])) {
            throw new NotFoundException('Метка не найдена.');
        }

        return $tag;
    }

    public function save(Tag $tag)
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Ошибка сохранения метки.');
        }
    }

    public function remove(Tag $tag)
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Ошибка удаления метки.');
        }
    }
}
