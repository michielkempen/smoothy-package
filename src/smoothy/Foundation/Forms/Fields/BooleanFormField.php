<?php

namespace Smoothy\Foundation\Forms\Fields;

use App\Foundation\Forms\Fields\FormField;

class BooleanFormField extends FormField
{
    /**
     * @return string
     */
    public function getView() : string
    {
        return 'form.fields.booleanField';
    }
}