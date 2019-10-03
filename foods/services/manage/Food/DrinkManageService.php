<?php


namespace foods\services\manage\Food;

use foods\entities\Food\Drink;
use foods\repositories\Food\DrinkRepository;

class DrinkManageService
{
    private $drink;

    public function __construct(DrinkRepository $drink)
    {
        $this->drink = $drink;
    }

    public function create(DrinkForm $form)
    {

    }

    public function edit(DrinkForm $form)
    {

    }

    public function remove($id)
    {
        /* @var Drink $drink */
        $drink = $this->drink->get($id);
        $this->drink->remove($drink);
    }
}
