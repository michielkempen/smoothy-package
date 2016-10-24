<?php

namespace Smoothy\Api\Responses\Models\Custom\Types;

use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\BooleanField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\FilesField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\SelectField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\TextAreaField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\TextField;

class Type
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
    private $fields;

    /**
     * Type constructor.
     *
     * @param int $id
     * @param Collection $name
     * @param Collection $fields
     */
    public function __construct(
        int $id,
        Collection $name,
        Collection $fields
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->fields = $fields;
    }

    /**
     * @param array $attributes
     * @return Type
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['id'],
            collect($attributes['name']),
            collect($attributes['fields'])->map(function($item) {
                switch ($item['type']) {
                    case class_basename(BooleanField::class):
                        return BooleanField::create($item);
                    case class_basename(FilesField::class):
                        return FilesField::create($item);
                    /*
                    case class_basename(PasswordField::class):
                        return PasswordField::create($item);
                    */
                    case class_basename(SelectField::class):
                        return SelectField::create($item);
                    case class_basename(TextField::class):
                        return TextField::create($item);
                    case class_basename(TextAreaField::class):
                        return TextAreaField::create($item);
                    /*
                    case class_basename(WysiwygField::class):
                        return WysiwygField::create($item);
                    */
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
     * @return Collection
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }
}