<?php

return [

    'dynamics' => env('DYNAMICS_USE_SANDBOX')
        ? [
            'instance_uri' => env('DYNAMICS_SANDBOX_INSTANCE_URI'),
            'application_id' => env('DYNAMICS_SANDBOX_APPLICATION_ID'),
            'application_secret' => env('DYNAMICS_SANDBOX_APPLICATION_SECRET'),
        ]
        : [
            'instance_uri' => env('DYNAMICS_INSTANCE_URI'),
            'application_id' => env('DYNAMICS_APPLICATION_ID'),
            'application_secret' => env('DYNAMICS_APPLICATION_SECRET'),
        ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => 'http://backend.net:8000/google-auth/callback',
    ],

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

];
