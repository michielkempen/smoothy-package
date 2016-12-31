<?php

namespace Smoothy\Api\Responses;

use GuzzleHttp\Psr7\Response;
use Smoothy\Api\Exceptions\ResponseException;
use Smoothy\Api\Requests\SmoothyApiRequest;

class ResponseParser
{
    /**
     * @param Response $response
     * @param SmoothyApiRequest $request
     * @return SmoothyApiResponse
     * @throws ResponseException
     */
    public function parse(Response $response, SmoothyApiRequest $request)
    {
        $response = $this->parseToSmoothyApiResponse($response);

        return ($request->getRequest()->getMethod() == 'GET')
            ? $this->parseGetResponse($response, $request)
            : $this->parseOtherResponse($response);
    }

    /**
     * @param SmoothyApiResponse $response
     * @param SmoothyApiRequest $request
     * @return mixed|SmoothyApiResponse
     * @throws ResponseException
     */
    private function parseGetResponse(SmoothyApiResponse $response, SmoothyApiRequest $request)
    {
        if(!$response->isSuccessFull())
            throw new ResponseException($response);

        return is_null($request->getTransformer())
            ? $response
            : $request->getTransformer()->transform($response);
    }

    /**
     * @param SmoothyApiResponse $response
     * @return SmoothyApiResponse
     * @throws ResponseException
     */
    private function parseOtherResponse(SmoothyApiResponse $response)
    {
        if($response->isSuccessFull() || $response->containsValidationErrors())
            return $response;

        dd($response);
        throw new ResponseException($response);
    }

    /**
     * @param Response $response
     * @return SmoothyApiResponse
     */
    private function parseToSmoothyApiResponse(Response $response) : SmoothyApiResponse
    {
        return new SmoothyApiResponse(
            json_decode($response->getBody()->getContents(), true),
            $response->getStatusCode()
        );
    }
}