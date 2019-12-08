<?php

$app->group('/api/user', function () use ($app){

    $app->post('/register', \App\Controller\UserController::class  . ':registerUser');

    $app->post('/login', \App\Controller\UserController::class . ':loginUser');

    $app->get('/logout', \App\Controller\UserController::class . ':logoutUser')
        ->add(\App\Middleware\JwtMiddleware::class);

    $app->put('/change/password', \App\Controller\UserController::class . ':changePassword')
        ->add(\App\Middleware\JwtMiddleware::class);

    $app->get('/personal/info', \App\Controller\UserController::class . ':personalInfo')
        ->add(\App\Middleware\JwtMiddleware::class);

    $app->put('/total/time', \App\Controller\UserController::class . ':totalTime')
        ->add(\App\Middleware\JwtMiddleware::class);

    $app->get('/total/score', \App\Controller\AnalyseController::class . ':totalScoreGamePlay')
        ->add(\App\Middleware\JwtMiddleware::class);

    $app->post('/store/score', \App\Controller\ScoreController::class . ':store')
        ->add(\App\Middleware\JwtMiddleware::class);

    $app->get('/score', \App\Controller\ScoreController::class . ':getScore')
        ->add(\App\Middleware\JwtMiddleware::class);
});

$app->get('/api/levels', \App\Controller\LevelController::class . ':showLevels')
    ->add(\App\Middleware\JwtMiddleware::class);

$app->get('/api/forgot/password', \App\Controller\UserController::class . ':forgotPassword');

