<?php

namespace Smoothy\Foundation\Forms\Fields;

class SelectFormField extends TextFormField
{
    /**
     * @var array
     */
    private $options;

    /**
     * SelectFormField constructor.
     *
     * @param string $label
     * @param string $hint
     * @param bool $required
     * @param array $options
     */
    public function __construct(
        string $label,
        string $hint,
        bool $required,
        array $options
    )
    {
        parent::__construct($label, '', $hint, $required);

        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
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