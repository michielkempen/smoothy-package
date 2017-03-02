<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class WysiwygFormField extends TextAreaFormField
{
    /**
     * TextFormField constructor.
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     */
    public function __construct(
        Translation $label,
        Translation $hint,
        bool $required
    )
    {
        parent::__construct($label, new Translation([]), $hint, $required);
    }

    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'type' => 'wysiwygField'
        ]);
    }
}