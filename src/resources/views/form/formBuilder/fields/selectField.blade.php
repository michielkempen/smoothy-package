@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'selectField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-mouse-pointer"></i>

    <select
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
    >
        <option value="" selected @if($field->isRequired()) disabled @endif>{{ trans('smoothy::form.selectPlaceholder') }}</option>
        @foreach($field->getOptions() as $option)
            <option value="{{ $option }}">
                {{ $option }}
            </option>
        @endforeach
    </select>

    <i class="fa fa-angle-down"></i>

@overwrite