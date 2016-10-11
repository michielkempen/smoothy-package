<?php

namespace Smoothy\Api\FormBuilder\Models\Field;

use Smoothy\Foundation\Forms\Fields\SelectFormField;

class SelectField extends SelectFormField implements Field
{
    /** @var int */
    private $id;

    /** @var int */
    private $formId;

    /**
     * SelectField constructor.
     * @param int $id
     * @param int $formId
     * @param string $label
     * @param string $hint
     * @param bool $required
     * @param array $options
     */
    public function __construct(
        int $id,
        int $formId,
        string $label,
        string $hint,
        bool $required,
        array $options = []
    )
    {
        parent::__construct($label, $hint, $required, $options);

        $this->id = $id;
        $this->formId = $formId;
    }

    /**
     * @param array $attributes
     * @return SelectField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['form_id'],
            $attributes['label'],
            $attributes['hint'],
            $attributes['required'],
            $attributes['options']
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return 'field'.$this->getId();
    }

    /**
     * @return int
     */
    public function getFormId() : int
    {
        return $this->formId;
    }

    /**
     * @return bool
     */
    public function isMultiple()
    {
        return false; // TODO: change
    }
}