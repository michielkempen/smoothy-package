<?php

namespace Smoothy\Api\Wrapper\Custom\Forms;

use Smoothy\Api\Requests\SmoothyApiRequest;

class FormsApi
{
    /**
     * Add record to a custom module form.
     *
     * @param int $moduleId
     * @param int $itemId
     * @param string $language
     * @param array $formData
     * @return SmoothyApiRequest
     */
    public function create(int $moduleId, int $itemId, string $language, array $formData)
    {
        return (new SmoothyApiRequest)
            ->post('custom/'.$moduleId.'/items/'.$itemId.'/form')
            ->parameter('language', $language)
            ->data($formData);
    }
}