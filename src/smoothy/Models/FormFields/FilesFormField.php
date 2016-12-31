<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class FilesFormField extends FormField
{
    /**
     * @var Collection
     */
    private $fileTypes;

    /**
     * @var bool
     */
    private $multiple;

    /**
     * FilesFormField constructor.
     *
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $fileTypes
     */
    public function __construct(
        Translation $label,
        Translation $hint,
        bool $required,
        bool $multiple,
        Collection $fileTypes
    )
    {
        parent::__construct($label, $hint, $required);

        $this->fileTypes = $fileTypes;
        $this->multiple = $multiple;
    }

    /**
     * @return boolean
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @return Collection
     */
    public function getFileTypes(): Collection
    {
        return $this->fileTypes;
    }

    /**
     * @return bool
     */
    public function hasFileTypes(): bool
    {
        return !$this->fileTypes->isEmpty();
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

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.filesField';
    }
}