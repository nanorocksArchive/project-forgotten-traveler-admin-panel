<?php

// Container and dependencies
$container = $app->getContainer();

// Database access
require_once __DIR__ . '/../storage/db/class/Database.php';
$container['db'] = function ($container){

    $db = new Database(
        $container->get('settings')['db']['drive'],
        __DIR__ . '/../storage',
        $container->get('settings')['db']['filename']
    );

    $db->setConnection();
    return $db;
};

// Controllers
$container[\App\Controller\BaseController::class] = function ($container) {
    return new \App\Controller\BaseController($container);
};

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
$container['jwt'] = function ($container) {
    return \App\Middleware\JwtMiddleware::class;
};
