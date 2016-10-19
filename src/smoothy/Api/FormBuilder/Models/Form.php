<?php

namespace Smoothy\Api\FormBuilder\Models;

use Illuminate\Support\Collection;
use Smoothy\Api\FormBuilder\Models\Field\BooleanField;
use Smoothy\Api\FormBuilder\Models\Field\FilesField;
use Smoothy\Api\FormBuilder\Models\Field\SelectField;
use Smoothy\Api\FormBuilder\Models\Field\TextAreaField;
use Smoothy\Api\FormBuilder\Models\Field\TextField;

class Form
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collection
     */
    private $name;

    /**
     * @var Collection
     */
    private $description;

    /**
     * @var Collection
     */
    private $explanation;

    /**
     * @var Collection
     */
    private $successMessage;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * Form constructor.
     *
     * @param int $id
     * @param Collection $name
     * @param Collection $description
     * @param Collection $explanation
     * @param Collection $successMessage
     * @param Collection $fields
     */
    public function __construct(
        int $id,
        Collection $name,
        Collection $description,
        Collection $explanation,
        Collection $successMessage,
        Collection $fields
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->explanation = $explanation;
        $this->successMessage = $successMessage;
        $this->id = $id;
        $this->fields = $fields;
    }

    /**
     * @param array $attributes
     * @return Form
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['id'],
            collect($attributes['name']),
            collect($attributes['description']),
            collect($attributes['explanation']),
            collect($attributes['success_message']),
            collect($attributes['fields'])->map(function($item) {
                switch ($item['type'])
                {
                    case class_basename(BooleanField::class):
                        return BooleanField::create($item);
                    case class_basename(FilesField::class):
                        return FilesField::create($item);
                    case class_basename(SelectField::class):
                        return SelectField::create($item);
                    case class_basename(TextField::class):
                        return TextField::create($item);
                    case class_basename(TextAreaField::class):
                        return TextAreaField::create($item);
                    default:
                        return null;
                }
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
     * @param string $language
     * @return Collection|string|null
     */
    public function getName(string $language = null)
    {
        return is_null($language)
            ? $this->name
            : $this->name->get($language, null);
    }

    /**
     * @param string $language
     * @return Collection|string|null
     */
    public function getDescription(string $language = null)
    {
        return is_null($language)
            ? $this->description
            : $this->description->get($language, null);
    }

    /**
     * @param string $language
     * @return Collection|string|null
     */
    public function getExplanation(string $language = null)
    {
        return is_null($language)
            ? $this->explanation
            : $this->explanation->get($language, null);
    }

    /**
     * @param string $language
     * @return Collection
     */
    public function getSuccessMessage(string $language = null)
    {
        return is_null($language)
            ? $this->successMessage
            : $this->successMessage->get($language, null);
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }
}