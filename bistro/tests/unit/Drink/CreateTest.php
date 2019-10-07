<?php

namespace bistro\tests\unit\Drink;

use Codeception\Test\Unit;
use bistro\entities\Food\Drink;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $drink = Drink::create(
            $name = 'test'
        );

        $this->assertEquals($name, $drink->name);
    }
}
