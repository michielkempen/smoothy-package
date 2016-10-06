@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'urlField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-globe"></i>

    <input
        type="url"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite