<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

//    'google' => [
//        'client_id' => '135199843918-5nfas0v56eb4qa1r31dkerri7i5t4v2g.apps.googleusercontent.com',
//        'client_secret' => 'p6rOEqFBJ5pmkcq4vNW_0zPx',
//        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
//    ],

    'google' => [
        'client_id' => env('GOOGLE_LOGIN_ID'),
        'client_secret' => env('GOOGLE_LOGIN_SECRET'),
        'redirect' => env('GOOGLE_LOGIN_REDIRECT'),
    ],
];
