<?php


namespace Smoothy\Api\FormBuilder;

use Illuminate\Support\Collection;
use Smoothy\Api\FormBuilder\Models\Form;
use Smoothy\Api\SmoothyApi;
use Smoothy\Foundation\Api\ApiException;
use Smoothy\Foundation\Api\ApiResponse;

class FormBuilderApi
{
    private $api;

    public function __construct(SmoothyApi $api)
    {
        $this->api = $api;
    }

    /**
     * Get forms from a formBuilder module.
     *
     * @param int $moduleId
     * @param string|null $language
     * @param int|null $perPage
     * @param int|null $page
     * @return Collection
     * @throws ApiException
     */
    public function getForms(
        int $moduleId,
        string $language,
        int $perPage = null,
        int $page = null
    )
    {
        $request = $this->api->newRequest()
            ->get('formbuilder/forms')
            ->parameter('module_id', $moduleId)
            ->parameter('language', $language)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return FormBuilderApiTransformer::transformGetFormsResponse(
                $response
            );

        throw new ApiException($response);
    }

    /**
     * Get form fields of a formBuilder module.
     *
     * @param int $formId
     * @param string|null $language
     * @return Form
     * @throws ApiException
     */
    public function getForm(
        int $formId,
        string $language
    )
    {
        $request = $this->api->newRequest()
            ->get('formbuilder/form')
            ->parameter('form_id', $formId)
            ->parameter('language', $language);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return FormBuilderApiTransformer::transformGetFormResponse(
                $response
            );

        throw new ApiException($response);
    }

    /**
     * Add record to a formBuilder module.
     *
     * @param int $formId
     * @param array $formData
     * @return ApiResponse
     * @throws ApiException
     */
    public function addRecord(
        int $formId,
        array $formData
    )
    {
        $request = $this->api->newRequest()
            ->post('formbuilder/records/create')
            ->parameter('form_id', $formId)
            ->data($formData);

        $response = $this->api->call($request);

        if($response->isSuccessFull() || $response->containsValidationErrors())
            return $response;

        throw new ApiException($response);
    }
}