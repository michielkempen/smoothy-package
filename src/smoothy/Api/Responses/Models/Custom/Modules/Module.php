<?php

namespace Smoothy\Api\Responses\Models\Custom\Modules;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class Module
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collection
     */
    private $languages;

    /**
     * @var Translation
     */
    private $name;

    /**
     * @var Collection
     */
    private $types;

    /**
     * Module constructor.
     * @param int $id
     * @param Collection $languages
     * @param Translation $name
     * @param Collection $types
     */
    public function __construct(
        int $id,
        Collection $languages,
        Translation $name,
        Collection $types
    )
    {
        $this->id = $id;
        $this->languages = $languages;
        $this->name = $name;
        $this->types = $types;
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
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @return Translation
     */
    public function getName(): Translation
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }
}