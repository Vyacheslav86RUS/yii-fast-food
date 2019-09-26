<?php

namespace foods\services\manage\Food;

use foods\entities\Food\Characteristic;
use foods\forms\manage\Food\CharacteristicForm;
use foods\repositories\Food\CharacteristicRepository;

class CharacteristicManageService
{
    private $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicForm $form)
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);

        return $characteristic;
    }

    public function edit($id, CharacteristicForm $form)
    {
        /* @var Characteristic $characteristic*/
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
    }

    public function remove($id)
    {
        /* @var Characteristic $characteristic*/
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }
}
