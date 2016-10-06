@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'dateField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-calendar"></i>

    <input
        type="date"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite