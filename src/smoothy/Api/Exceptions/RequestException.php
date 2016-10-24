<?php

namespace Smoothy\Api\Exceptions;

class RequestException extends \Exception
{
    public static function noMethodSet(): RequestException
    {
        return new static('No method set.');
    }
}