<?php

// DI Container configuration
$container = $app->getContainer();

// Logger
$container['logger'] = function($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new \Monolog\Logger( $settings['name'] );
    $fileHandler = new \Monolog\Handler\StreamHandler( $settings['path'] );
    $logger->pushHandler( $fileHandler, $settings['level'] );

    return $logger;
};

// Database connection
$container['db'] = function ($c) {
    $settings = $c->get('settings')['database'];

    $pdo = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['databaseName'],
        $settings['username'],
        $settings['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("SET NAMES {$settings['charset']} COLLATE {$settings['collation']};");

    return $pdo;
};

// Twig middleware
$container['view'] = function ($c) {
    $router = $c->get('router');
    $settings = $c->get('settings')['renderer'];

    $view = new \Slim\Views\Twig( $settings['path'], [
        'cache' => $settings['cache'] ? $settings['cachePath'] : $settings['cache'],
        'debug' => $settings['debug']
    ]);

    // Instantiate and add Slim specific extension
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};
