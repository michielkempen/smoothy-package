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
     * @param string $language
     * @param array $formData
     * @return SmoothyApiRequest
     */
    public function create(int $moduleId, int $formId, string $language, array $formData)
    {
        return (new SmoothyApiRequest)
            ->post('formbuilder/'.$moduleId.'/forms/'.$formId.'/records')
            ->parameter('language', $language)
            ->data($formData);
    }
}