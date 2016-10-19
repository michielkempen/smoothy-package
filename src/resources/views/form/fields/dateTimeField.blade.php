@extends('smoothy::form.fields.field', [
    'type' => 'dateTimeField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-calendar"></i>

    <input
        type="datetime"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite