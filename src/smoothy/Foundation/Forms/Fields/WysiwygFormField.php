<?php

namespace Smoothy\Foundation\Forms\Fields;

use Illuminate\Support\Collection;

class WysiwygFormField extends TextAreaFormField
{
    /**
     * TextFormField constructor.
     * @param Collection $label
     * @param Collection $hint
     * @param bool $required
     */
    public function __construct(
        Collection $label,
        Collection $hint,
        bool $required
    )
    {
        parent::__construct($label, collect(), $hint, $required);
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.wysiwygField';
    }
}