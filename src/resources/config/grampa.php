<?php

return [
    /*
     * Grandfathered installation route protection.
     * If true, will enable basic auth for that route.
     */
    'protected' => env('GRAMPA_ROUTE_PROTECTED', true),

    /*
     * Basic auth credentials for grandfathered installation route.
     */
    'protection' => [
        'login' => env('GRAMPA_LOGIN', 'admin'),
        'pass'  => env('GRAMPA_PASS', 'admin')
    ]
];