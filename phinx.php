<?php
require_once './vendor/autoload.php';

// Instantiate the app
$config = require __DIR__ . '/application/configs/config.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/application/configs/dependencies.php';

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'development' => [
            'name' => $settings['settings']['database']['database'],
            'connection' => $container->get('db')->getConnection()->getPdo(),
        ],
        'production' => [
            'adapter' => $settings['settings']['database']['driver'],
            'host' => $settings['settings']['database']['host'],
            'name' => $settings['settings']['database']['database'],
            'user' => $settings['settings']['database']['username'],
            'pass' => $settings['settings']['database']['password'],
            'port' => $settings['settings']['database']['port'],
            'charset' => $settings['settings']['database']['charset'],
            'collation' => $settings['settings']['database']['collation'],
            'prefix'    => $settings['settings']['database']['prefix'],
        ],
        'testing' => [
            'adapter' => $settings['settings']['database']['driver'],
            'host' => $settings['settings']['database']['host'],
            'name' => $settings['settings']['database']['database'],
            'user' => $settings['settings']['database']['username'],
            'pass' => $settings['settings']['database']['password'],
            'port' => $settings['settings']['database']['port'],
            'charset' => $settings['settings']['database']['charset'],
            'collation' => $settings['settings']['database']['collation'],
            'prefix'    => $settings['settings']['database']['prefix'],
        ]
    ],
    'version_order' => 'creation'
];
