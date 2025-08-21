<?php
use Illuminate\Support\Str;

return [
    'driver' => env('SESSION_DRIVER', 'database'),

    // Session lifetime in minutes
    'lifetime' => env('SESSION_LIFETIME', 120),

    // Session cookie settings
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/sessions'),
    'connection' => env('SESSION_CONNECTION'),
    'table' => 'sessions',
    'store' => env('SESSION_STORE'),
    'lottery' => [2, 100],
    'cookie' => env('SESSION_COOKIE', Str::slug(env('APP_NAME', 'laravel'), '_').'_session'),
    'path' => '/',
    'domain' => env('SESSION_DOMAIN'),
    'secure' => env('SESSION_SECURE_COOKIE'),
    'http_only' => true,
    'same_site' => 'lax',
];

// Also update your .env file:
/*
SESSION_DRIVER=database
SESSION_LIFETIME=120
*/