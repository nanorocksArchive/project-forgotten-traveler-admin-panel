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

$container['AdminController'] = function ($container) {
    return new \App\Controller\AdminController($container);
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

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
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
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setEventDispatcher(new Illuminate\Events\Dispatcher(new Illuminate\Container\Container));

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function () use ($capsule) {
    return $capsule;
};
// --------------------------------------------------------------
