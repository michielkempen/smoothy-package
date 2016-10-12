@extends('smoothy::form.fields.field', [
    'type' => 'filesField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-file"></i>

    <input
        type="file"
        name="{{ $field->getName() }}"
        data-multiple-caption=":count bestanden geselecteerd"
    >

    <label for="{{ $field->getName() }}">Selecteer bestanden..</label>

@overwrite