<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms\Fields;

interface FormField
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
    public function getFormId() : int;
}