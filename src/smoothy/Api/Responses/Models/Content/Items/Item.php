<?php

namespace Smoothy\Api\Responses\Models\Content\Items;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Item
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $moduleId;

    /**
     * @var int
     */
    private $parentItemId;

    /**
     * @var int
     */
    private $typeId;

    /**
     * @var Collection
     */
    private $languages;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * CustomPage constructor.
     *
     * @param int $id
     * @param int $moduleId
     * @param int $parentItemId
     * @param int $typeId
     * @param Collection $languages
     * @param Carbon $date
     * @param Collection $fields
     */
    public function __construct(
        int $id,
        int $moduleId,
        int $parentItemId,
        int $typeId,
        Collection $languages,
        Carbon $date,
        Collection $fields
    )
    {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->moduleId = $moduleId;
        $this->parentItemId = $parentItemId;
        $this->languages = $languages;
        $this->date = $date;
        $this->fields = $fields;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getModuleId(): int
    {
        return $this->moduleId;
    }

    /**
     * @return int
     */
    public function getParentItemId() : int
    {
        return $this->parentItemId;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @param int $fieldId
     * @return mixed
     */
    public function getField(int $fieldId)
    {
        return $this->fields->get($fieldId);
    }
}