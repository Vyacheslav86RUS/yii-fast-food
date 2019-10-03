<?php

namespace foods\forms\manage\Food;

use foods\forms\CompositeForm;

class SauceForm extends CompositeForm
{
    protected function internalForms()
    {
        return ['meta', 'category', 'img'];
    }
}
