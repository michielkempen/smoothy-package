@extends('smoothy::form.fields.field', [
    'type' => 'colorField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-eyedropper"></i>

    <input
        type="color"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite