<?php

namespace bistro\tests\unit\Drink;

use bistro\entities\Meta;
use Codeception\Test\Unit;
use bistro\entities\Food\Drink;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $drink = Drink::create(
            $name = 'test',
            $meta = new Meta('title', 'description', 'keywords')
        );

        $this->assertEquals($name, $drink->name);
        $this->assertEquals($meta, $drink->meta);
    }
}
