<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id'     => '203872900287582',
        'client_secret' => '031f8c3474c3c33e9f89ce19a282df2d',
        'redirect'      => 'http://localhost:8080/thepetfamily/public/login/facebook/callback',
    ],


    'google' => [
        'client_id'     => '412104356276-gl38jrcppi7a9od1dgc636q1v4vrka4d.apps.googleusercontent.com',
        'client_secret' => 'g8RHkeozn56diceP0Upfbr8s',
        'redirect'      => 'http://localhost:8080/thepetfamily/public/login/google/callback',
    ],
];
