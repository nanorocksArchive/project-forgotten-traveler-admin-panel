<?php

$app->group('/api/user', function () use ($app){

    $app->post('/register', \App\Controller\UserController::class  . ':registerUser');

    $app->post('/login', \App\Controller\UserController::class . ':loginUser');

    $app->get('/logout', \App\Controller\UserController::class . ':logoutUser')->add(\App\Middleware\JwtMiddleware::class);

    $app->put('/change/password', \App\Controller\UserController::class . ':changePassword')->add(\App\Middleware\JwtMiddleware::class);;

    $app->get('/personal/info', \App\Controller\UserController::class . ':personalInfo')->add(\App\Middleware\JwtMiddleware::class);;

});