@extends('smoothy::form.fields.field', [
    'type' => 'urlField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-globe"></i>

    <input
        type="url"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite