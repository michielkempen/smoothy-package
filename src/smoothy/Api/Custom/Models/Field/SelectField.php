<?php

namespace Smoothy\Api\Custom\Models\Field;

use Illuminate\Support\Collection;
use Smoothy\Foundation\Forms\Fields\SelectFormField;

class SelectField extends SelectFormField implements Field
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $typeId;

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
        $this->typeId = $formId;
    }

    /**
     * @param array $attributes
     * @return SelectField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['type_id'],
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
    public function getTypeId() : int
    {
        return $this->typeId;
    }

    /**
     * @return bool
     */
    public function isMultiple()
    {
        return false; // TODO: change
    }
}