@extends('smoothy::form.fields.field', [
    'type' => 'filesField',
    'required' => $field->isRequired()
])

@section('field')

    <div class="dropzone"></div>

@overwrite