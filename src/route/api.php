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

$app->get('/', \App\Controller\UserController::class . ':index');

