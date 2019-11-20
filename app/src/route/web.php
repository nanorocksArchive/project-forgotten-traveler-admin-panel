<?php

$app->get('/', \App\Controller\UserController::class  . ':index');

$app->post('/login', \App\Controller\UserController::class . ':loginWeb')
    ->setName('login.page')
    ->add(\App\Middleware\AuthMiddleware::class);


$app->group('', function (){

    $this->get('/dashboard', \App\Controller\UserController::class . ':dashboard');

    $this->get('/new-level', \App\Controller\UserController::class . ':newLevelWeb');
    $this->post('/store/new-level', \App\Controller\UserController::class . ':storeNewLevelWeb');

    $this->get('/edit-level', \App\Controller\UserController::class . ':editLevelWeb');
    $this->post('/update-level', \App\Controller\UserController::class . ':updateLevelWeb');

})->add(\App\Middleware\GuestMiddleware::class);