<?php

namespace Smoothy\Api\Website\Models;

class Website
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * Website constructor.
     * @param string $status
     * @param string $redirectUri
     */
    public function __construct(string $status, string $redirectUri)
    {
        $this->status = $status;
        $this->redirectUri = $redirectUri;
    }

    /**
     * @param array $attributes
     * @return Website
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['status'],
            $attributes['redirect_uri']
        );
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }
}