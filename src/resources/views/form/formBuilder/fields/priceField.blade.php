@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'priceField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-money"></i>

    <input
        type="number"
        step=".01"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite