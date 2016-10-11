<?php

namespace Smoothy\Foundation\Forms\Fields;

class BooleanFormField extends FormField
{
    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.booleanField';
    }
}