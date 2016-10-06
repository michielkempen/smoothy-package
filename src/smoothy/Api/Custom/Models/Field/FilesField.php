<?php

namespace Smoothy\Api\Custom\Models\Field;

use Illuminate\Support\Collection;

class FilesField extends Field
{
    /**
     * @var int
     */
    private $minimumNumber;

    /**
     * @var int
     */
    private $maximumNumber;

    /**
     * @var Collection
     */
    private $fileTypes;

    /**
     * FilesField constructor.
     * @param array $label
     * @param array $hint
     * @param int $minimumNumber
     * @param int $maximumNumber
     * @param Collection $fileTypes
     * @param int $id
     * @param int $moduleId
     */
    public function __construct(
        int $id,
        int $moduleId,
        array $label,
        array $hint,
        int $minimumNumber,
        int $maximumNumber,
        Collection $fileTypes
    )
    {
        parent::__construct($id, $moduleId, $label, $hint);

        $this->minimumNumber = $minimumNumber;
        $this->maximumNumber = $maximumNumber;
        $this->fileTypes = $fileTypes;
    }

    /**
     * @param array $attributes
     * @return FilesField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['module_id'],
            $attributes['label'],
            $attributes['hint'],
            $attributes['minimum_number'],
            $attributes['maximum_number'],
            $attributes['file_types']
        );
    }

    /**
     * @return int
     */
    public function getMinimumNumber()
    {
        return $this->minimumNumber;
    }

    /**
     * @return int
     */
    public function getMaximumNumber()
    {
        return $this->maximumNumber == 0
            ? 1000
            : $this->maximumNumber;
    }

    /**
     * @return Collection
     */
    public function getFileTypes(): Collection
    {
        return $this->fileTypes;
    }

    /**
     * @return string
     */
    public function getFileTypesString() : string
    {
        $result = '';

        $this->fileTypes->each(function($fileType) use (&$result) {
            if($result != '')
                $result .= ',';
            $result .= $fileType;
        });

        return $result;
    }
}