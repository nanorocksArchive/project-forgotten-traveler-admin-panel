<?php


// Container and dependencies
$container = $app->getContainer();

// Controllers
$container[\App\Controller\UserController::class] = function ($container) {
    return new \App\Controller\UserController($container);
};

// Container for error logs
//$container['logger-error'] = function($c) use ($config) {
//    $logger = new \Monolog\Logger('request');
//    $file_handler = new \Monolog\Handler\StreamHandler($config['logs']['error']);
//    $logger->pushHandler($file_handler);
//    return $logger;
//};

// Container for database logs
//$container['logger-database'] = function($c) use ($config) {
//    $logger = new \Monolog\Logger('database');
//    $file_handler = new \Monolog\Handler\StreamHandler($config['logs']['database']);
//    $logger->pushHandler($file_handler);
//    return $logger;
//};

// Container for JsonWebToken Middleware
//$container['jwt'] = function ($c) use ($config) {
//    return \App\Middleware\JwtMiddleware::class;
//};
