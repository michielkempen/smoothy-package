<?php

namespace Smoothy\Api\Wrapper\FormBuilder;

use Smoothy\Api\Wrapper\FormBuilder\Forms\FormsApi;
use Smoothy\Api\Wrapper\FormBuilder\Records\RecordsApi;

class FormBuilderApi
{
    /**
     * @return FormsApi
     */
    public function forms() : FormsApi
    {
        return new FormsApi;
    }

    /**
     * @return RecordsApi
     */
    public function records() : RecordsApi
    {
        return new RecordsApi;
    }
}