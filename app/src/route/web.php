<?php

$app->get('/', \App\Controller\AdminController::class  . ':index');

$app->post('/login', \App\Controller\AdminController::class . ':loginWeb')
    ->setName('login.page')
    ->add(\App\Middleware\AuthMiddleware::class);


$app->group('', function (){

    $this->get('/dashboard', \App\Controller\AdminController::class . ':dashboard')->setName('dashboard');

    $this->get('/new/level', \App\Controller\AdminController::class . ':newLevelWeb')->setName('new.level');
    $this->post('/store/new/level', \App\Controller\AdminController::class . ':storeNewLevelWeb')->setName('store.level');

    $this->get('/edit/level/{id}', \App\Controller\AdminController::class . ':editLevelWeb');
    $this->post('/update/level/{id}', \App\Controller\AdminController::class . ':updateLevelWeb')->setName('update.level');

})->add(\App\Middleware\GuestMiddleware::class);