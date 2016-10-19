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
    private $transformer;

    public function __construct(SmoothyApi $api)
    {
        $this->api = $api;
        $this->transformer = new FormBuilderApiTransformer;
    }

    /**
     * Get forms from a formBuilder module.
     *
     * @param int $moduleId
     * @param int|null $perPage
     * @param int|null $page
     * @return Collection
     * @throws ApiException
     */
    public function getAllForms(
        int $moduleId,
        int $perPage = null,
        int $page = null
    )
    {
        $request = $this->api->newRequest()
            ->get('formbuilder/forms/all')
            ->parameter('module_id', $moduleId)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetAllFormsResponse(
                $response
            );

        throw new ApiException($response);
    }

    /**
     * Get form fields of a formBuilder module.
     *
     * @param int $formId
     * @return Form
     * @throws ApiException
     */
    public function getForm(
        int $formId
    )
    {
        $request = $this->api->newRequest()
            ->get('formbuilder/forms/get')
            ->parameter('form_ids', [$formId]);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetFormsResponse(
                $response
            )->first();

        throw new ApiException($response);
    }

    /**
     * Get form fields of a formBuilder module.
     *
     * @param array $formIds
     * @return Form
     * @throws ApiException
     */
    public function getForms(
        array $formIds
    )
    {
        $request = $this->api->newRequest()
            ->get('formbuilder/forms/get')
            ->parameter('form_ids', $formIds);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetFormsResponse(
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
    public function createRecord(
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