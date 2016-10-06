<div class="form">

    @foreach($module->getFields() as $field)

        @include('smoothy::form.custom.fields', compact($field))

    @endforeach

</div>