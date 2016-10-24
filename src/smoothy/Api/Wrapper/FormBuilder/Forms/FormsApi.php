<?php

namespace Smoothy\Api\Wrapper\FormBuilder\Forms;

use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\FormBuilder\Forms\AllTransformer;
use Smoothy\Api\Responses\Transformers\FormBuilder\Forms\GetTransformer;

class FormsApi
{
    /**
     * Get forms from a formBuilder module.
     *
     * @param int $moduleId
     * @param int|null $perPage
     * @param int|null $page
     * @return SmoothyApiRequest
     */
    public function all(int $moduleId, int $perPage = null, int $page = null)
    {
        return (new SmoothyApiRequest)
            ->get('formbuilder/'.$moduleId.'/forms')
            ->parameter('per_page', $perPage)
            ->parameter('page', $page)
            ->transform(new AllTransformer);
    }

    /**
     * Get form fields of a formBuilder module.
     *
     * @param int $moduleId
     * @param int $formId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId, int $formId)
    {
        return (new SmoothyApiRequest)
            ->get('formbuilder/'.$moduleId.'/forms/'.$formId)
            ->transform(new GetTransformer);
    }
}