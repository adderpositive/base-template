<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Controllers\HomeController;
use Middleware\TrailingMiddleware;

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$config = require __DIR__ . '/application/configs/config.php';
$app = new \Slim\App( $config );

// Set up dependencies
require __DIR__ . '/application/configs/dependencies.php';

// Register middleware
$app->add( new TrailingMiddleware() );

// Register routes
$app->get('/', HomeController::class)
    ->setName('home');

// Start app after configuration
$app->run();
