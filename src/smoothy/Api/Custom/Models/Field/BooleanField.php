<?php

namespace Smoothy\Api\Custom\Models\Field;

class BooleanField extends Field
{
    public function getView()
    {
        return 'smoothy::form.fields.booleanField';
    }
}