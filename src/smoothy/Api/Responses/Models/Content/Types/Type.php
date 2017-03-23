<?php

namespace Smoothy\Api\Responses\Models\Content\Types;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class Type
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collection
     */
    private $fieldGroups;

    /**
     * @var Translation
     */
    private $notification;

    /**
     * Type constructor.
     *
     * @param int $id
     * @param Collection $fieldGroups
     * @param Translation $notification
     */
    public function __construct(
        int $id,
        Collection $fieldGroups,
        Translation $notification = null
    )
    {
        $this->id = $id;
        $this->fieldGroups = $fieldGroups;
        $this->notification = $notification;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getFieldGroups(): Collection
    {
        return $this->fieldGroups;
    }

    /**
     * @return Translation|null
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return new Collection([
            'id' => $this->id,
            'field_groups' => $this->fieldGroups->map(function(TypeFieldGroup $group) {
                return $group->serialize();
            }),
            'notification' => is_null($this->notification) ? null : (string) $this->notification
        ]);
    }
}