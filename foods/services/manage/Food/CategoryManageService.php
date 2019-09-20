<?php

namespace foods\services\manage\Food;

use foods\entities\Food\Category;
use foods\entities\Meta;
use foods\forms\manage\Food\CategoryForm;
use foods\repositories\Food\CategoryRepositories;

class CategoryManageService
{
    private $categories;

    public function __construct(CategoryRepositories $category)
    {
        $this->categories = $category;
    }

    public function create(CategoryForm $form)
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $category->appendTo($parent);
        $this->categories->save($category);

        return $category;
    }

    public function edit($id, CategoryForm $form)
    {
        /* @var Category $category*/
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        if ($form->parentId !== $category->parent->id) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function remove($id)
    {
        /* @var Category $category*/
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $this->categories->remove($category);
    }
    private function assertIsNotRoot(Category $category)
    {
        if ($category->isRoot()) {
            throw new \DomainException('Невозможно управлять корневой категорией.');
        }
    }
}
