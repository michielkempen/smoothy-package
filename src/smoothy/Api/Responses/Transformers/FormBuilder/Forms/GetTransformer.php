<?php

namespace Smoothy\Api\Responses\Transformers\FormBuilder\Forms;

use Smoothy\Api\Responses\Models\FormBuilder\Forms\Form;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Form
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($item) {
            return Form::create($item);
        });
    }
}