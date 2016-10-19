@extends('smoothy::form.fields.field', [
    'type' => 'textField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-font"></i>

    <input
        type="text"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite