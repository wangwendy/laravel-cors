<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => ['http://eimp.xinyuapp.net', 'http://localhost'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['Origin', 'Content-Type', 'Cookie', 'X-CSRF-TOKEN', 'Accept', 'Authorization', 'X-XSRF-TOKEN'],
    'allowedMethods' => ['GET', 'POST', 'PATCH', 'PUT', 'OPTIONS'],
    'exposedHeaders' => ['Authorization', 'authenticated'],
    'maxAge' => 0,

];
