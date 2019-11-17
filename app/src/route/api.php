<?php

//
//$app->get('/', function (Request $request, Response $response, array $args) use ($container) {
//
//    //var_dump($container['logger']->error('err msg'));
//    $response->getBody()->write("Hello World");
//
//    return $response;
//
//})->setName('onload')->add($container['jwt']);

$app->group('/api/user', function (){

    $controller = \App\Controller\UserController::class;
    $middleware = \App\Middleware\JwtMiddleware::class;

    $this->post('/register', $controller  . ':registerApi');
    $this->post('/login', $controller . ':loginApi');
    $this->post('/edit/password', $controller . ':editApi')->add($middleware);
});

$app->post('/api/forgot/password', \App\Controller\UserController::class . ':forgotPasswordApi');

//$this->get('/api/total/users', \App\Controller\UserController::class . ':totalApi');



