<?php

namespace Smoothy\Api\FormBuilder\Models\Field;

use Illuminate\Support\Collection;
use Smoothy\Foundation\Forms\Fields\FilesFormField;

class FilesField extends FilesFormField implements Field
{
    /** @var int */
    private $id;

    /** @var int */
    private $formId;

    /**
     * FilesField constructor.
     * @param int $id
     * @param int $formId
     * @param string $label
     * @param string $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $fileTypes
     */
    public function __construct(
        int $id,
        int $formId,
        string $label,
        string $hint,
        bool $required,
        bool $multiple,
        Collection $fileTypes
    )
    {
        parent::__construct($label, $hint, $required, $multiple, $fileTypes);

        $this->id = $id;
        $this->formId = $formId;
    }

    /**
     * @param array $attributes
     * @return FilesField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['form_id'],
            $attributes['label'],
            $attributes['hint'],
            $attributes['required'],
            $attributes['multiple'],
            collect($attributes['file_types'])
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