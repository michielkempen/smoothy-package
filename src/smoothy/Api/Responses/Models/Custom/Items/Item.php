<?php

namespace Smoothy\Api\Responses\Models\Custom\Items;

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
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * CustomPage constructor.
     *
     * @param int $id
     * @param int $order
     * @param int $typeId
     * @param int $moduleId
     * @param int $parentItemId
     * @param Collection $fields
     * @param Carbon $createdAt
     * @param Carbon $updatedAt
     */
    public function __construct(
        int $id,
        int $order,
        int $typeId,
        int $moduleId,
        int $parentItemId,
        Carbon $createdAt,
        Carbon $updatedAt,
        Collection $fields
    )
    {
        $this->id = $id;
        $this->order = $order;
        $this->typeId = $typeId;
        $this->moduleId = $moduleId;
        $this->parentItemId = $parentItemId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->fields = $fields;
    }

    /**
     * @param array $attributes
     * @return Item
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['id'],
            $attributes['order'],
            $attributes['type_id'],
            $attributes['module_id'],
            $attributes['parent_item_id'],
            Carbon::parse($attributes['created_at']['date']),
            Carbon::parse($attributes['updated_at']['date']),
            collect($attributes['fields'])->mapToAssoc(function($field) {
                return [
                    $field['field_id'],
                    is_array($field['value'])
                        ? collect($field['value'])
                        : $field['value']
                ];
            })
        );
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
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }
}