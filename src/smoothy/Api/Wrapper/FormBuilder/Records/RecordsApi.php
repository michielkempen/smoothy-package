<?php

namespace Smoothy\Api\Wrapper\FormBuilder\Records;

use Smoothy\Api\Requests\SmoothyApiRequest;

class RecordsApi
{
    /**
     * Add record to a formBuilder module.
     *
     * @param int $moduleId
     * @param int $formId
     * @param array $formData
     * @return SmoothyApiRequest
     */
    public function create(int $moduleId, int $formId, array $formData)
    {
        return (new SmoothyApiRequest)
            ->post('formbuilder/'.$moduleId.'/forms/'.$formId.'/records')
            ->data($formData);
    }
}