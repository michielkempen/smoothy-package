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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $explanation;

    /**
     * @var string
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
     * @param string $name
     * @param string $description
     * @param string $explanation
     * @param string $successMessage
     * @param Collection $fields
     */
    public function __construct(int $id, string $name, string $description, string $explanation, string $successMessage, Collection $fields)
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
            $attributes['name'],
            $attributes['description'],
            $attributes['explanation'],
            $attributes['success_message'],
            collect($attributes['fields'])->map(function($item) {
                switch ($item['type'])
                {
                    case getClassName(BooleanField::class):
                        return BooleanField::create($item);
                    case getClassName(FilesField::class):
                        return FilesField::create($item);
                    case getClassName(SelectField::class):
                        return SelectField::create($item);
                    case getClassName(TextField::class):
                        return TextField::create($item);
                    case getClassName(TextAreaField::class):
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getExplanation(): string
    {
        return $this->explanation;
    }

    /**
     * @return string
     */
    public function getSuccessMessage(): string
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
}