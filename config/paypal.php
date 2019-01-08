<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default PAYPAL PHP SDK settings
    |--------------------------------------------------------------------------
    |
    | This is an example configuration file for the SDK.
    | The sample scripts configure the SDK dynamically
    | but you can choose to go for file based configuration
    | in simpler apps.
    |
    */

    //-- Replace these values by entering your own Client Id and Secret Id
    //-- by visiting https://developer.paypal.com/developer/applications/
    //-- You should use the .env file for this data though.
    'client_id' => env('PAYPAL_CLIENT_ID', '[Enter your Client ID here]'),
    'secret' => env('PAYPAL_CLIENT_SECRET', '[Enter your Client Secret ID here]'),


    'settings' => [

        //-- Determines which PayPal endpoint URL will be
        //-- used with your application.
        //-- Possible values are
        //-- live or sandbox.
        'mode' => env('PAYPAL_MODE', 'sandbox'),

        //-- Settings for PayPalDefaultLogFactory
        //-- Possible values are true or false.
        'log.LogEnabled' => true,

        //-- When using a relative path, the log file is created
        //-- relative to the .php file that is the entry point
        //-- for this request.
        //-- You can also provide an absolute path here:
        //-- Settings for PayPalDefaultLogFactory
        'log.FileName' => storage_path('logs/paypal.log'),

        //-- Logging level can be one of any provided at \Psr\Log\LogLevel
        //-- Logging is most verbose in the 'DEBUG' level and
        //-- decreases as you proceed towards ERROR
        //-- DEBUG level is disabled for live, to not log sensitive information.
        //-- If the level is set to DEBUG, it will be reduced to INFO automatically.
        //-- Imho you should use `INFO` level for logging in live environments.
        'log.LogLevel' => 'DEBUG',
    ]
];
