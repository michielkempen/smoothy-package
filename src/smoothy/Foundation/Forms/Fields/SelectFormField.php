<?php

namespace Smoothy\Foundation\Forms\Fields;

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
     * @return Collection
     */
    public function getOptions() : Collection
    {
        return $this->options;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getOption(string $key)
    {
        return $this->options[$key];
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.selectField';
    }
}