<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Optimizations
    |--------------------------------------------------------------------------
    |
    | These settings control various performance optimizations for the application.
    |
    */

    // Enable query caching
    'query_cache' => [
        'enabled' => true,
        'ttl' => 3600, // 1 hour
    ],

    // Enable response caching
    'response_cache' => [
        'enabled' => true,
        'ttl' => 1800, // 30 minutes
    ],

    // Lazy load relationships by default
    'lazy_load' => true,

    // Eager load common relationships
    'eager_load' => [
        'user' => ['currentCompany', 'roles', 'permissions'],
        'hardware' => ['hardwareType', 'user', 'provaider', 'company'],
        'peripheral' => ['user', 'company'],
        'software' => ['user', 'company'],
    ],

    // Asset optimization
    'assets' => [
        'minify_css' => true,
        'minify_js' => true,
        'combine_files' => true,
    ],

    // Database optimizations
    'database' => [
        'persistent_connections' => true,
        'statement_caching' => true,
        'query_log' => false, // Disable in production
    ],
];
