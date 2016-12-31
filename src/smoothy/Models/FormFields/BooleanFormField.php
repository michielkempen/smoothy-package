<?php

namespace Smoothy\Models\FormFields;

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