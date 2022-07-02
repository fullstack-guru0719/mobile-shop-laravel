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
        '/products/sell/payment-method',
        '/device',
        '/api/customer/verification',
        '/api/customer/verification/resend',
        '/webhooks/twilio'
        //
        // 'admin/pagebuilder/{id}/build'
    ];
}
