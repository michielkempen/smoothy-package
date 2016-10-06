<?php

namespace Smoothy\Api\Custom\Models;

use Carbon\Carbon;

class Page
{
    private $id;
    private $order;
    private $customId;
    private $moduleId;
    private $parentId;
    private $fields;
    private $createdAt;
    private $updatedAt;

    /**
     * CustomPage constructor.
     *
     * @param int $id
     * @param int $order
     * @param int $customId
     * @param int $moduleId
     * @param int $parentId
     * @param array $fields
     * @param Carbon $createdAt
     * @param Carbon $updatedAt
     */
    public function __construct(
        int $id,
        int $order,
        int $customId,
        int $moduleId,
        int $parentId,
        array $fields,
        Carbon $createdAt,
        Carbon $updatedAt
    )
    {
        $this->id = $id;
        $this->order = $order;
        $this->customId = $customId;
        $this->moduleId = $moduleId;
        $this->parentId = $parentId;
        $this->fields = collect($fields)->mapToAssoc(function($field) {
            return [$field['field_id'], $field['value']];
        });
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param array $attributes
     * @return Page
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['id'],
            $attributes['order'],
            $attributes['custom_id'],
            $attributes['module_id'],
            $attributes['parent_id'],
            $attributes['fields'],
            Carbon::parse($attributes['created_at']['date']),
            Carbon::parse($attributes['updated_at']['date'])
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
    public function getCustomId(): int
    {
        return $this->customId;
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
    public function getParentId() : int
    {
        return $this->parentId;
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