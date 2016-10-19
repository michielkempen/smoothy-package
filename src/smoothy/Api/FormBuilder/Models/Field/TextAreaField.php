<?php

namespace Smoothy\Api\FormBuilder\Models\Field;

use Illuminate\Support\Collection;
use Smoothy\Foundation\Forms\Fields\TextAreaFormField;

class TextAreaField extends TextAreaFormField implements Field
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $formId;

    /**
     * TextAreaField constructor.
     * @param int $id
     * @param int $formId
     * @param Collection $label
     * @param Collection $placeholder
     * @param Collection $hint
     * @param bool $required
     */
    public function __construct(
        int $id,
        int $formId,
        Collection $label,
        Collection $placeholder,
        Collection $hint,
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
            collect($attributes['label']),
            collect($attributes['placeholder']),
            collect($attributes['hint']),
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