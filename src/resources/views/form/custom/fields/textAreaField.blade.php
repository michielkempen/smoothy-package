@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'textAreaField',
    'required' => $field->isRequired()
])

@section('field')

    <textarea
        name="{{ $field->getName() }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >{{ old($field->getName()) }}</textarea>

@overwrite