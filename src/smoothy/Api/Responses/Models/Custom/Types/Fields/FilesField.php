<?php

namespace Smoothy\Api\Responses\Models\Custom\Types\Fields;

use Illuminate\Support\Collection;
use Smoothy\FormFields\FilesFormField;

class FilesField extends FilesFormField implements Field
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
     * FilesField constructor.
     * @param int $id
     * @param int $formId
     * @param Collection $label
     * @param Collection $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $fileTypes
     */
    public function __construct(
        int $id,
        int $formId,
        Collection $label,
        Collection $hint,
        bool $required,
        bool $multiple,
        Collection $fileTypes
    )
    {
        parent::__construct($label, $hint, $required, $multiple, $fileTypes);

        $this->id = $id;
        $this->typeId = $formId;
    }

    /**
     * @param array $attributes
     * @return FilesField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['type_id'],
            collect($attributes['label']),
            collect($attributes['hint']),
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
    public function getTypeId() : int
    {
        return $this->typeId;
    }
}