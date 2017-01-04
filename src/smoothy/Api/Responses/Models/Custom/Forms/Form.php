<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class Form
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Translation
     */
    private $successMessage;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * @var Carbon|null
     */
    private $publishedFrom;

    /**
     * @var Carbon|null
     */
    private $publishedUntil;

    /**
     * Form constructor.
     *
     * @param int $id
     * @param Translation $successMessage
     * @param Collection $fields
     * @param Carbon $publishedFrom
     * @param Carbon $publishedUntil
     */
    public function __construct(
        int $id,
        Translation $successMessage,
        Collection $fields,
        Carbon $publishedFrom = null,
        Carbon $publishedUntil = null
    )
    {
        $this->id = $id;
        $this->successMessage = $successMessage;
        $this->fields = $fields;
        $this->publishedFrom = $publishedFrom;
        $this->publishedUntil = $publishedUntil;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Translation
     */
    public function getSuccessMessage()
    {
        return $this->successMessage;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @return Carbon|null
     */
    public function getPublishedFrom()
    {
        return $this->publishedFrom;
    }

    /**
     * @return Carbon|null
     */
    public function getPublishedUntil()
    {
        return $this->publishedUntil;
    }

    /**
     * @return boolean
     */
    public function isPublished(): bool
    {
        $now = Carbon::now()->timezone('utc');

        if(is_null($this->publishedFrom))
            return false;

        if($now->lt($this->publishedFrom))
            return false;

        if(!is_null($this->publishedUntil) && $now->gt($this->publishedUntil))
            return false;

        return true;
    }
}