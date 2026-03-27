<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'webhook/payrant',
        'api/vtstack/webhook',
        'api/vtstack',
        'home/create_topup_order',
        'user/generate-virtual-account',
        'user/update-name',
        'my/name/submit',
    ];
}
