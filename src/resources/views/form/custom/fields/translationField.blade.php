@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'translationField'
])

@section('field')

    <i class="fa fa-font"></i>

    <input
        type="text"
        name="{{ $field->getName() }}[{{ currentLocale() }}]"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite