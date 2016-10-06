<?php

namespace Smoothy\Foundation\Api;

class ApiResponse
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var
     */
    private $content;

    /**
     * ApiResponse constructor.
     *
     * @param $content
     * @param int $statusCode
     */
    public function __construct($content, int $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return bool
     */
    public function isSuccessFull()
    {
        return ((int) substr($this->statusCode, 0, 1)) == 2;
    }

    /**
     * @return bool
     */
    public function containsValidationErrors()
    {
        return $this->statusCode == 422;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}