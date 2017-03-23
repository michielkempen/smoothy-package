<?php

namespace Smoothy\Api\Responses\Models\Content\Types\Fields;

interface TypeField
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;
}