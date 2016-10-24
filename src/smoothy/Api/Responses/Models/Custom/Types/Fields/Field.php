<?php

namespace Smoothy\Api\Responses\Models\Custom\Types\Fields;

interface Field
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getTypeId() : int;
}