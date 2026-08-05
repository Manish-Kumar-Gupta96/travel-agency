<?php

namespace App\Http;

class Request extends \App\Core\Http\Request
{
    /**
     * Capture request
     */
    public static function capture(): static
    {
        return new static();
    }
}
