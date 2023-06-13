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

    /*'sendinblue' => [
        // api-key or partner-key
        'key_identifier' => env('SENDINBLUE_KEY_IDENTIFIER', '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'),
        'key' => env('BWXsw6tSYnE1Lh7y'),
    ],*/
	
	/*'sendinblue' => ['key_identifier'=> 'api-key', 'key' => env('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')],*/

];
