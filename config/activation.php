<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Activation Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default activation options for your application.
    | You may change these defaults as required, but they're a perfect start
    | for most applications.
    |
    */

    'defaults' => [
        'activations' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activations
    |--------------------------------------------------------------------------
    |
    | You may specify multiple activation configurations if you have more
    | than one user table or model in the application and you want to have
    | separate activation settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */
    'activations' => [
        'users' => [
            'provider' => 'users',
            'table' => 'activations',
            'expire' => 60 * 24,
        ],
        'admin_users' => [
            'provider' => 'admin_users',
            'table' => 'admin_activations',
            'expire' => 60,
        ],
    ],
];
