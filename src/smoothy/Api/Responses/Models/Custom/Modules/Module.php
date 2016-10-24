<?php

namespace Smoothy\Api\Responses\Models\Custom\Modules;

use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Types\Type;

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
     * @var Collection
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
     * @param Collection $name
     * @param Collection $types
     */
    public function __construct(
        int $id,
        Collection $languages,
        Collection $name,
        Collection $types
    )
    {
        $this->id = $id;
        $this->languages = $languages;
        $this->name = $name;
        $this->types = $types;
    }

    /**
     * @param array $attributes
     * @return Module
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['id'],
            collect($attributes['languages']),
            collect($attributes['name']),
            collect($attributes['types'])->map(function($type) {
                return Type::create($type);
            })
        );
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
     * @return Collection
     */
    public function getName(): Collection
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