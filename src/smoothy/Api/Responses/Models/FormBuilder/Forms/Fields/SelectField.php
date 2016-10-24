<?php

namespace Smoothy\Api\Responses\Models\FormBuilder\Forms\Fields;

use Illuminate\Support\Collection;
use Smoothy\FormFields\SelectFormField;

class SelectField extends SelectFormField implements Field
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
     * SelectField constructor.
     * @param int $id
     * @param int $formId
     * @param Collection $label
     * @param Collection $hint
     * @param bool $required
     * @param Collection $options
     */
    public function __construct(
        int $id,
        int $formId,
        Collection $label,
        Collection $hint,
        bool $required,
        Collection $options
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
            collect($attributes['label']),
            collect($attributes['hint']),
            $attributes['required'],
            collect($attributes['options'])
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