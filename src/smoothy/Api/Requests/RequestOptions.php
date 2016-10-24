<?php

namespace Smoothy\Api\Requests;

use Illuminate\Http\UploadedFile;

class RequestOptions
{
    public function get(ApiRequest $request) : array
    {
        $options = [
            'http_errors' => false
        ];

        if(!empty($request->getData()))
        {
            $options['multipart'] = array();

            foreach ($request->getData() as $name => $value)
            {
                $fields = array();
                $fields['name'] = $name;

                if(is_array($value))
                {
                    $fields['contents'] = json_encode($value);
                }
                elseif($value instanceof UploadedFile)
                {
                    $fields['contents'] = fopen($value->getRealPath(), 'r');
                    $fields['filename'] = $value->getClientOriginalName();
                }
                else
                {
                    $fields['contents'] = $value;
                }

                array_push($options['multipart'], $fields);
            }
        }

        return $options;
    }
}