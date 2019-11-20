<?php

// Container and dependencies
$container = $app->getContainer();

// Controllers here
$container[\App\Controller\BaseController::class] = function ($container) {
    return new \App\Controller\BaseController($container);
};

$container[\App\Controller\UserController::class] = function ($container) {
    return new \App\Controller\UserController($container);
};

// Middleware here
$container['GuestMiddleware'] = function ($container) {
    return new \App\Middleware\GuestMiddleware($container);
};

$container['AuthMiddleware'] = function ($container) {
    return new \App\Middleware\AuthMiddleware($container);
};

// Session here
$container['session'] = function ($container) {
    return new \SlimSession\Helper;
};


// Container for JsonWebToken Middleware
$container['jwt'] = function ($container) {
    return \App\Middleware\JwtMiddleware::class;
};

// Twig template engine
$container['twig'] = function ($container) {
    $view = new \Slim\Views\Twig($container->get('settings')['template']['path'], [
        'cache' => false//$container->get('settings')['template']['cache'],
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

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