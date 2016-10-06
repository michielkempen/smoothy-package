@if(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\BooleanField::class)

    @include('smoothy::form.formBuilder.fields.booleanField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\ColorField::class)

    @include('smoothy::form.formBuilder.fields.colorField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\DateField::class)

    @include('smoothy::form.formBuilder.fields.dateField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\DateTimeField::class)

    @include('smoothy::form.formBuilder.fields.dateTimeField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\DecimalField::class)

    @include('smoothy::form.formBuilder.fields.decimalField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\EmailField::class)

    @include('smoothy::form.formBuilder.fields.emailField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\FilesField::class)

    @include('smoothy::form.formBuilder.fields.filesField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\IntegerField::class)

    @include('smoothy::form.formBuilder.fields.integerField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\IpAddressField::class)

    @include('smoothy::form.formBuilder.fields.ipAddressField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\PercentageField::class)

    @include('smoothy::form.formBuilder.fields.percentageField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\PriceField::class)

    @include('smoothy::form.formBuilder.fields.priceField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\SelectField::class)

    @include('smoothy::form.formBuilder.fields.selectField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\TextField::class)

    @include('smoothy::form.formBuilder.fields.textField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\TextAreaField::class)

    @include('smoothy::form.formBuilder.fields.textAreaField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\TimeField::class)

    @include('smoothy::form.formBuilder.fields.timeField', compact('field'))

@elseif(getClassName($field, false) == \Smoothy\Api\FormBuilder\Models\Field\UrlField::class)

    @include('smoothy::form.formBuilder.fields.urlField', compact('field'))

@endif