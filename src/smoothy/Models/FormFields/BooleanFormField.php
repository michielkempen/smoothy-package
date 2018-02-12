<?php

namespace Smoothy\Models\FormFields;

class BooleanFormField extends FormField
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'booleanField';
    }
}