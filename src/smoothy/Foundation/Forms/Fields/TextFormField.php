<?php

namespace Smoothy\Foundation\Forms\Fields;

use Illuminate\Support\Collection;

class TextFormField extends FormField
{
    /**
     * @var Collection
     */
    private $placeholder;

    /**
     * TextFormField constructor.
     * @param Collection $label
     * @param Collection $placeholder
     * @param Collection $hint
     * @param bool $required
     */
    public function __construct(
        Collection $label,
        Collection $placeholder,
        Collection $hint,
        bool $required
    )
    {
        parent::__construct($label, $hint, $required);

        $this->placeholder = $placeholder;
    }

    /**
     * @param string $language
     * @return Collection|null|string
     */
    public function getPlaceholder(string $language = null)
    {
        return is_null($language)
            ? $this->placeholder
            : $this->placeholder->get($language, null);
    }

    /**
     * @param string $language
     * @return bool
     */
    public function hasPlaceholder(string $language) : bool
    {
        return !is_null($this->getPlaceholder($language));
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.textField';
    }
}