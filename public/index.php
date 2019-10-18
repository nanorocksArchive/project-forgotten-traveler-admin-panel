<?php

// Vendor load
require __DIR__ .'/../vendor/autoload.php';

// Setup config
$config = require_once __DIR__ . '/../src/config.php';

// App start
$app = new \Slim\App(['settings' => $config]);

// Container dependencies
$container = $app->getContainer();
require_once __DIR__ . '/../src/container.php';

// Middleware load
require_once __DIR__ . '/../middleware/JwtMiddleware.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function (Request $request, Response $response, array $args) {

 //   var_dump($this->logger->info('hello from /hello/{name}'));
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;

})->setName('onload')->add( new JwtMiddleware());



// Running the app
$app->run();