<?php

namespace Smoothy\Api\Responses\Transformers\FormBuilder\Forms;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\FormBuilder\Forms\Form;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class AllTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return LengthAwarePaginator|Collection
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->possiblyPaginatedCollection($response, function($item) {
            return Form::create($item);
        });
    }
}