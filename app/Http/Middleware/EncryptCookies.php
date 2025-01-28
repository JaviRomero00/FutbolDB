<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Los nombres de las cookies que deben ser excluidas de la encriptación.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
