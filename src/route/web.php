<?php

$app->get('/', \App\Controller\UserController::class . ':index');

$app->get('/login', \App\Controller\UserController::class . ':loginWeb');
