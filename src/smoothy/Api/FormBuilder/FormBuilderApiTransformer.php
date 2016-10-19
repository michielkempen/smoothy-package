<?php

namespace Smoothy\Api\FormBuilder;

use Illuminate\Support\Collection;
use Smoothy\Api\FormBuilder\Models\Form;
use Smoothy\Foundation\Api\ApiResponse;
use Smoothy\Foundation\Api\ApiTransformer;

class FormBuilderApiTransformer extends ApiTransformer
{
    /**
     * @param ApiResponse $response
     * @return Collection
     */
	public function transformGetFormsResponse(ApiResponse $response) : Collection
	{
	    return $this->transformCollection($response, function($item) {
            return Form::create($item);
        });
	}

    /**
     * @param ApiResponse $response
     * @return Form
     */
	public function transformGetFormResponse(ApiResponse $response) : Form
	{
		return Form::create(
            $response->getContent()['data']
        );
	}
}