<?php

namespace Smoothy\Api\FormBuilder;

use Illuminate\Support\Collection;
use Smoothy\Api\FormBuilder\Models\Form;
use Smoothy\Foundation\Api\ApiResponse;

class FormBuilderApiTransformer
{
    /**
     * @param ApiResponse $response
     * @return Collection
     */
	public static function transformGetFormsResponse(ApiResponse $response) : Collection
	{
        return collect($response->getContent()['data'])->map(function($item) {
            return Form::create($item);
        });
	}

    /**
     * @param ApiResponse $response
     * @return Form
     */
	public static function transformGetFormResponse(ApiResponse $response) : Form
	{
		return Form::create(
            $response->getContent()['data']
        );
	}

	public static function transformAddRecordResponse(ApiResponse $response)
	{
		return null;
	}
}