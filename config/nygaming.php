<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Endpoint Environment
    |--------------------------------------------------------------------------
    |
    | NewYorkGaming API Endpoint Environment staging or production (default)
    | By default, the API Endpoint is set to staging.
    */

    'sandbox' => env('NYG_SANDBOX', true),


    /*
    |--------------------------------------------------------------------------
    | API Endpoint
    |--------------------------------------------------------------------------
    |
    | NewYorkGaming API Endpoint
    | There are two options: staging and production (default)
    | You can change this value in config/newyorkgaming.php
    | Stage: 'https://game.newyorkgaming.net/api
    | Production: 'https://game.newyorkgaming.net/api
    */

    'base_url' => [
        'staging' => 'https://game.newyorkgaming.net/api',
        'production' => 'https://game.newyorkgaming.net/api'
    ],


    /*
    |--------------------------------------------------------------------------
    | API KEY
    |--------------------------------------------------------------------------
    |
    | NewYorkGaming API KEY
    | You can change this value in config/newyorkgaming.php
    |
    */
    'api_key' => env('NYG_API_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | SHOP ID
    |--------------------------------------------------------------------------
    |
    | NewYorkGaming SHOP ID
    | You can change this value in config/newyorkgaming.php
    |
    */
    'shop_id' => env('NYG_SHOP_ID', null),

    /*
    |--------------------------------------------------------------------------
    | AUTH TOKEN
    |--------------------------------------------------------------------------
    |
    | NewYorkGaming AUTH TOKEN
    | You can change this value in config/newyorkgaming.php
    |
    */
    'auth_token' => env('NYG_AUTH_TOKEN', null),
];
