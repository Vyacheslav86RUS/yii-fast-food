<?php


namespace foods\repositories\Food;

use foods\entities\Food\Category;
use foods\repositories\NotFoundException;

class CategoryRepository
{
    public function get($id)
    {
        if (!$category = Category::findOne(['id' => $id])) {
            throw new NotFoundException('Категория не найдена.');
        }
        return $category;
    }
    public function save(Category $category)
    {
        if (!$category->save()) {
            throw new \RuntimeException('Ошибка сохранения категории.');
        }
    }
    public function remove(Category $category)
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Ошибка удаления категории.');
        }
    }
}
