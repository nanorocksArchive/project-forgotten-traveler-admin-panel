<?php

$app->get('/', \App\Controller\UserController::class . ':index');

$app->get('/login', \App\Controller\UserController::class . ':loginWeb');

$app->get('/dashboard', \App\Controller\UserController::class . ':dashboard');

$app->get('/new-level', \App\Controller\UserController::class . ':newLevelWeb');

$app->get('/edit-level', \App\Controller\UserController::class . ':editLevelWeb');