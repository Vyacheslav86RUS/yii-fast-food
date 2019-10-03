<?php

namespace foods\forms\manage\Food;

use foods\forms\CompositeForm;

class SnackForm extends CompositeForm
{
    protected function internalForms()
    {
        return ['meta', 'category', 'img'];
    }
}
