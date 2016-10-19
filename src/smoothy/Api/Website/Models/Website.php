<?php

namespace Smoothy\Api\Website\Models;

class Website
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string|null
     */
    private $redirectUri;

    /**
     * Website constructor.
     * @param string $status
     * @param string $redirectUri
     */
    public function __construct(string $status, string $redirectUri = null)
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
     * @return string|null
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }
}