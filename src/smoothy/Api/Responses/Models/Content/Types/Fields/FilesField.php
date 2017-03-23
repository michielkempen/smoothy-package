<?php

namespace Smoothy\Api\Responses\Models\Content\Types\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\FilesFormField;
use Smoothy\Models\Translation;

class FilesField extends FilesFormField implements TypeField
{
    /**
     * @var int
     */
    private $id;

    /**
     * FilesField constructor.
     *
     * @param int $id
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param bool $multiple
     * @param int $maximumNumber
     * @param Collection $fileTypes
     */
    public function __construct(
        int $id,
        Translation $label,
        Translation $hint,
        bool $required,
        bool $multiple,
        int $maximumNumber,
        Collection $fileTypes
    )
    {
        parent::__construct($label, $hint, $required, $multiple, $maximumNumber, $fileTypes);

        $this->id = $id;
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
}