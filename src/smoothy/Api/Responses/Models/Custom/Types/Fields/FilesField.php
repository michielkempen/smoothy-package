<?php

namespace Smoothy\Api\Responses\Models\Custom\Types\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\FilesFormField;
use Smoothy\Models\Translation;

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
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $fileTypes
     */
    public function __construct(
        int $id,
        int $formId,
        Translation $label,
        Translation $hint,
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