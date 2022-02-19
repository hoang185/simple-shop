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
    'facebook' => [
        'client_id' => '428642048813431',
        'client_secret' => '3fbd138aa7712ffd6c0ce402b2b4d414',
        'redirect' => 'https://simple-shop-185.herokuapp.com/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '688268960109-dv8vha59objah8rpgi4qq4pdrmrc3oat.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://simple-shop-185.herokuapp.com/auth/google/callback',
    ],

];
