<?php

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/../../.env') ) {
    $dotenv = Dotenv::create(__DIR__ . '/../../');
    $dotenv->load();
}

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true' ? true : true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // App Settings
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
            'host' => getenv('DB_HOST'),
            'databaseName' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
        'cors' => null !== getenv('CORS_ALLOWED_ORIGINS') ? getenv('CORS_ALLOWED_ORIGINS') : '*'
    ],
];
