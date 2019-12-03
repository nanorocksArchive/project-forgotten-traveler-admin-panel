<?php

$app->post('/api/user/register', \App\Controller\UserController::class  . ':registerUser');

$app->post('/api/user/login', \App\Controller\UserController::class . ':loginUser');

//$app->group('/api/user', function (){
//
//
//    $middleware = \App\Middleware\JwtMiddleware::class;
//    $this->post('/edit/password', \App\Controller\UserController::class . ':editApi')->add($middleware);
//});
//
//$app->post('/api/forgot/password', \App\Controller\UserController::class . ':forgotPasswordApi');
//
////$this->get('/api/total/users', \App\Controller\UserController::class . ':totalApi');
//
//
//
