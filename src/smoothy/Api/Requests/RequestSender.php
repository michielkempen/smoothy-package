<?php

namespace Smoothy\Api\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class RequestSender
{
    /**
     * @param SmoothyApiRequest $request
     * @return Response
     */
    public function send(SmoothyApiRequest $request) : Response
    {
        return app(Client::class)->send(
            $this->getRequest($request),
            $this->getRequestOptions($request)
        );
    }

    /**
     * @param SmoothyApiRequest $request
     * @return Request
     */
    private function getRequest(SmoothyApiRequest $request) : Request
    {
        return (new RequestParser)->parse($request->getRequest());
    }

    /**
     * @param SmoothyApiRequest $request
     * @return array
     */
    private function getRequestOptions(SmoothyApiRequest $request) : array
    {
        return $request->getRequest()->getOptions();
    }
}