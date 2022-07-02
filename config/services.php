<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_OAUTH_CLIENT_ID'),
        'client_secret' => env('GOOGLE_OAUTH_CLIENT_SECRET'),
        'redirect' => 'https://tronicspay.com/customer/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_OAUTH_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_OAUTH_CLIENT_SECRET'),
        'redirect' => 'https://tronicspay.com/customer/auth/facebook/callback',
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        'messaging_service_sid' => env('TWILIO_MESSAGING_SERVICE_SID'),
    ],

];
