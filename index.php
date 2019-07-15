<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Controllers\HomeController;
use Middleware\ExampleMiddleware;

require __DIR__ . '/vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = '127.0.0.1';
$config['db']['user']   = 'root';
$config['db']['pass']   = '';
$config['db']['dbname'] = 'onemanshow';

// Create app object
$app = new \Slim\App([
    'settings' => $config
]);

// DI Container
$container = $app->getContainer();

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('logger');
    $file_handler = new \Monolog\Handler\StreamHandler('./logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

// Database conncection
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// Twig middleware
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__ . '/application/views/', [
        //'cache' => './cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

// whole app middleware
$app->add( new ExampleMiddleware() );

// Routes
$app->get('/', HomeController::class)
    ->setName('home')
    ->add( new ExampleMiddleware() ); // route middleware

// Start app after configuration
$app->run();
