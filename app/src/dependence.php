<?php

// Container and dependencies
$container = $app->getContainer();
// --------------------------------------------------------------


// Controllers here
$container['BaseController'] = function ($container) {
    return new \App\Controller\BaseController($container);
};

$container['UserController'] = function ($container) {
    return new \App\Controller\UserController($container);
};
// --------------------------------------------------------------


// Middleware here
$container['GuestMiddleware'] = function ($container) {
    return new \App\Middleware\GuestMiddleware($container);
};

$container['AuthMiddleware'] = function ($container) {
    return new \App\Middleware\AuthMiddleware($container);
};

$container['jwt'] = function () {
    return \App\Middleware\JwtMiddleware::class;
};
// --------------------------------------------------------------


// Service here
$container['session'] = function () {
    return new \SlimSession\Helper;
};
// --------------------------------------------------------------


// Template engine
$container['twig'] = function ($container) {
    $view = new \Slim\Views\Twig($container['settings']['template']['path'], [
        'cache' => false//$container->get('settings')['template']['cache'],
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};
// --------------------------------------------------------------


// Database ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
// --------------------------------------------------------------


// Database access
//require_once __DIR__ . '/../storage/db/class/Database.php';
//$container['db'] = function ($container){
//
//    $db = new Database(
//        $container->get('settings')['db']['drive'],
//        __DIR__ . '/../storage',
//        $container->get('settings')['db']['filename']
//    );
//
//    $db->setConnection();
//    return $db;
//};

