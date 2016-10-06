<?php

namespace Smoothy\Api\FormBuilder\Models\Field;

use Smoothy\Foundation\Forms\Fields\TextAreaFormField;

class TextAreaField extends TextAreaFormField implements Field
{
    /** @var int */
    private $id;

    /** @var int */
    private $formId;

    /**
     * TextAreaField constructor.
     * @param int $id
     * @param int $formId
     * @param string $label
     * @param string $placeholder
     * @param string $hint
     * @param bool $required
     */
    public function __construct(
        int $id,
        int $formId,
        string $label,
        string $placeholder,
        string $hint,
        bool $required
    )
    {
        parent::__construct($label, $placeholder, $hint, $required);

        $this->id = $id;
        $this->formId = $formId;
    }

    /**
     * @param array $attributes
     * @return TextAreaFormField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['form_id'],
            $attributes['label'],
            $attributes['placeholder'],
            $attributes['hint'],
            $attributes['required']
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
}