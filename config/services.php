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
        'client_id' => '993272158624-6rit2eab3qtlckai5l4vi5chfgdp9cnf.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/traveljamii/auth/google/callback',
    ],

    'facebook' => [
        'client_id'     => '1154992311218806',
        'client_secret' => '5ae2af31b16d6acdb760761817f95425',
        'redirect'      => 'http://localhost/traveljamii/auth/facebook/callback',
    ]

];
