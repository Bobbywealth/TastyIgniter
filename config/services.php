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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Vapi (Voice AI)
    |--------------------------------------------------------------------------
    |
    | Vapi credentials used for:
    | - Web SDK on the marketing page (public key)
    | - Server-side REST API calls (secret/api key)
    | - Validating inbound webhooks/tool calls (webhook secret)
    |
    */
    'vapi' => [
        'base_url' => env('VAPI_BASE_URL', 'https://api.vapi.ai'),
        'api_key' => env('VAPI_API_KEY'), // secret key
        'public_key' => env('VAPI_PUBLIC_KEY'),
        'assistant_id' => env('VAPI_ASSISTANT_ID'),
        'webhook_secret' => env('VAPI_WEBHOOK_SECRET'),
    ],
];
