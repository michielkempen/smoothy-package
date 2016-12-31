<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Types;

use Smoothy\Api\Responses\Models\Custom\Types\Fields\BooleanField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\FilesField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\SelectField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\TextAreaField;
use Smoothy\Api\Responses\Models\Custom\Types\Fields\TextField;
use Smoothy\Api\Responses\Models\Custom\Types\Type;
use Smoothy\Api\Responses\Transformers\ModelTransformer;
use Smoothy\Models\Translation;

class TypeTransformer extends ModelTransformer
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function transform(array $attributes)
    {
        return new Type(
            $attributes['id'],
            collect($attributes['name']),
            collect($attributes['fields'])->map(function($item) {
                switch ($item['type']) {
                    case class_basename(BooleanField::class):
                        return $this->transformBooleanField($item);
                    case class_basename(FilesField::class):
                        return $this->transformFilesField($item);
                    /*
                    case class_basename(PasswordField::class):
                        return $this->transformPasswordField($item);
                    */
                    case class_basename(SelectField::class):
                        return $this->transformSelectField($item);
                    case class_basename(TextField::class):
                        return $this->transformTextField($item);
                    case class_basename(TextAreaField::class):
                        return $this->transformTextAreaField($item);
                    /*
                    case class_basename(WysiwygField::class):
                        return $this->transformWysiwygField($item);
                    */
                    default:
                        return null;
                }
            })
        );
    }

    private function transformBooleanField(array $attributes)
    {
        return new BooleanField(
            $attributes['id'],
            $attributes['type_id'],
            new Translation($attributes['label']),
            new Translation($attributes['hint']),
            $attributes['required']
        );
    }

    private function transformFilesField(array $attributes)
    {
        return new FilesField(
            $attributes['id'],
            $attributes['type_id'],
            new Translation($attributes['label']),
            new Translation($attributes['hint']),
            $attributes['required'],
            $attributes['multiple'],
            collect($attributes['file_types'])
        );
    }

    private function transformSelectField(array $attributes)
    {
        return new SelectField(
            $attributes['id'],
            $attributes['type_id'],
            new Translation($attributes['label']),
            new Translation($attributes['hint']),
            $attributes['required'],
            collect($attributes['options'])
        );
    }

    private function transformTextAreaField(array $attributes)
    {
        return new TextAreaField(
            $attributes['id'],
            $attributes['type_id'],
            new Translation($attributes['label']),
            new Translation($attributes['placeholder']),
            new Translation($attributes['hint']),
            $attributes['required']
        );
    }

    private function transformTextField(array $attributes)
    {
        return new TextField(
            $attributes['id'],
            $attributes['type_id'],
            new Translation($attributes['label']),
            new Translation($attributes['placeholder']),
            new Translation($attributes['hint']),
            $attributes['required']
        );
    }
}