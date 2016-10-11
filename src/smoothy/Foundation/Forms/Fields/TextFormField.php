<?php

namespace Smoothy\Foundation\Forms\Fields;

class TextFormField extends FormField
{
    /**
     * @var string
     */
    private $placeholder;

    /**
     * TextFormField constructor.
     * @param string $label
     * @param string $placeholder
     * @param string $hint
     * @param bool $required
     */
    public function __construct(
        string $label,
        string $placeholder,
        string $hint,
        bool $required
    )
    {
        parent::__construct($label, $hint, $required);

        $this->placeholder = $placeholder;
    }

    /**
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @return bool
     */
    public function hasPlaceholder() : bool
    {
        return $this->getPlaceholder() != '';
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.textField';
    }
}