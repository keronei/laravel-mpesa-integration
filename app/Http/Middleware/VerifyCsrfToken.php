<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //mpesa doesnt know which token to send, lets forgive it!
        'stripe/*',
        
        //forgive postman as well!
        '/callback',
    ];
}
