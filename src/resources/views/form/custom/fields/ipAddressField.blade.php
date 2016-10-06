@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'ipAddressField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-laptop"></i>

    <input
        type="text"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite