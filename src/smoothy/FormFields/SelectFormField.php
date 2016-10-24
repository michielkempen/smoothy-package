<?php

namespace Smoothy\FormFields;

use Illuminate\Support\Collection;

class SelectFormField extends TextFormField
{
    /**
     * @var Collection
     */
    private $options;

    /**
     * SelectFormField constructor.
     *
     * @param Collection $label
     * @param Collection $hint
     * @param bool $required
     * @param Collection $options
     */
    public function __construct(
        Collection $label,
        Collection $hint,
        bool $required,
        Collection $options
    )
    {
        parent::__construct($label, collect(), $hint, $required);

        $this->options = $options;
    }

    /**
     * @param string $language
     * @return array
     */
    public function getOptions(string $language) : array
    {
        return $this->options->get($language, []);
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.selectField';
    }
}