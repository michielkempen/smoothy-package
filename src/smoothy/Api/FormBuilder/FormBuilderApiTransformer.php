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
    public function transformGetAllFormsResponse(ApiResponse $response)
    {
        return $this->transformPossiblyPaginatedCollection($response, function($item) {
            return Form::create($item);
        });
    }

    /**
     * @param ApiResponse $response
     * @return Collection
     */
	public function transformGetFormsResponse(ApiResponse $response)
	{
	    return $this->transformPossiblyPaginatedCollection($response, function($item) {
            return Form::create($item);
        });
	}
}