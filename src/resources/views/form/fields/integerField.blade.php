@extends('smoothy::form.fields.field', [
    'type' => 'integerField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-calculator"></i>

    <input
        type="number"
        step="1"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite