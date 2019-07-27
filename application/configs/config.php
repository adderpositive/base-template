<?php

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/../../.env') ) {
    $dotenv = Dotenv::create(__DIR__ . '/../../');
    $dotenv->load();
}

$settings = [
    'settings' => [
        // App Settings
        'displayErrorDetails' => true,
        'addContentLengthHeader' => true,
        'app' => [
            'name' => getenv('APP_NAME'),
            'url' => getenv('APP_URL'),
            'env' => getenv('APP_ENV'),
        ],
        // Renderer settings
        'renderer' => [
            'path' => __DIR__ . '/../views/',
            'cache' => false,
            'cachePath' => __DIR__ . '/../../cache',
            'debug' => true,
        ],
        // Monolog settings
        'logger' => [
            'name' => getenv('APP_NAME'),
            'path' => __DIR__ . '/../../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // Database settings
        'database' => [
            'driver' => getenv('DB_CONNECTION'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
        'cors' => null !== getenv('CORS_ALLOWED_ORIGINS') ? getenv('CORS_ALLOWED_ORIGINS') : '*'
    ]
];

// Only production enviroment
if( getenv('APP_ENV') === 'PROD' ) {
    $settings['settings']['displayErrorDetails'] = false;
    $settings['settings']['addContentLengthHeader'] = false;
    $settings['settings']['renderer']['cache'] = true;
    $settings['settings']['renderer']['debug'] = false;
}

// App version according to enviroment
$settings['settings']['app']['version'] = getenv('APP_ENV') === 'PROD' ? getenv('APP_VERSION') : time();

// Database settings according to enviroment
$settings['settings']['database']['host']   = getenv('DB_' . getenv('APP_ENV') . '_HOST');
$settings['settings']['database']['username']   =  getenv('DB_' . getenv('APP_ENV') . '_USERNAME');
$settings['settings']['database']['password']   =  getenv('DB_' . getenv('APP_ENV') . '_PASSWORD');
$settings['settings']['database']['database'] =  getenv('DB_' . getenv('APP_ENV') . '_DATABASE');

return $settings;
