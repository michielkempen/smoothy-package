<?php

namespace Smoothy\Api\Responses\Models\Custom\Items;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Forms\Form;

class Item
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $order;

    /**
     * @var int
     */
    private $typeId;

    /**
     * @var int
     */
    private $moduleId;

    /**
     * @var int
     */
    private $parentItemId;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * @var Collection
     */
    private $languages;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var Form
     */
    private $form;

    /**
     * CustomPage constructor.
     *
     * @param int $id
     * @param int $order
     * @param int $typeId
     * @param int $moduleId
     * @param int $parentItemId
     * @param Collection $languages
     * @param Carbon $date
     * @param Collection $fields
     * @param Form $form
     */
    public function __construct(
        int $id,
        int $order,
        int $typeId,
        int $moduleId,
        int $parentItemId,
        Collection $languages,
        Carbon $date,
        Collection $fields,
        Form $form = null
    )
    {
        $this->id = $id;
        $this->order = $order;
        $this->typeId = $typeId;
        $this->moduleId = $moduleId;
        $this->parentItemId = $parentItemId;
        $this->date = $date;
        $this->fields = $fields;
        $this->languages = $languages;
        $this->form = $form;
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
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
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
     * @param int $fieldId
     * @return mixed
     */
    public function getField(int $fieldId)
    {
        return $this->fields->get($fieldId);
    }

    /**
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }
}