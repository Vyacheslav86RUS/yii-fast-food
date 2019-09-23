<?php

namespace foods\services\manage\Food;

use foods\entities\Food\Item;
use foods\entities\Meta;
use foods\forms\manage\Food\ItemForm;
use foods\forms\manage\MetaForm;
use foods\repositories\Food\ItemRepository;

class ItemManageService
{
    private $items;

    public function __construct(ItemRepository $items)
    {
        $this->items = $items;
    }

    public function create(ItemForm $form, MetaForm $metaForm)
    {
        $item = Item::create(
            $form->name,
            $form->slug,
            new Meta(
                $metaForm->title,
                $metaForm->description,
                $metaForm->keywords
            )
        );
        $this->items->save($item);

        return $item;
    }

    public function edit($id, ItemForm $form)
    {
        /* @var Item $item*/
        $item = $this->items->get($id);
        $item->edit(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->items->save($item);
    }

    public function remove($id)
    {
        /* @var Item $item*/
        $item = $this->items->get($id);
        $this->items->remove($item);
    }

}
