<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;

class PasswordFormField extends TextFormField
{
    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'type' => 'passwordField'
        ]);
    }
}