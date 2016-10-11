@extends('smoothy::form.fields.field', [
    'type' => 'textAreaField',
    'required' => $field->isRequired()
])

@section('field')

    <textarea
        name="{{ $field->getName() }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >{{ old($field->getName()) }}</textarea>

@overwrite