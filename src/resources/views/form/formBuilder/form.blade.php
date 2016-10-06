@foreach($form->getFields() as $field)

    @include('smoothy::form.formBuilder.fields', compact($field))

@endforeach