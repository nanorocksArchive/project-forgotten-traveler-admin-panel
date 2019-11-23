<?php

return [
    'displayErrorDetails' => true,
    'addContentLengthHeader'=> false,
    'db' => [
        'driver' => 'mysql',
        'host' => '94.237.88.91',
        'database' => 'nankovin_game',
        'username' => 'nankovin_game',
        'password' => 'confusionsnake32;',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
//    'db-old' => [
//        'drive' => 'sqlite',
//        'filename' => 'database.db'
//    ],
    'logs' => [
        'error' => __DIR__ . '/../logs/error.log',
        'database' => __DIR__ . '/../logs/database.log'
    ],
    'jws' => [
        'access' => 'Bearer ',
        'key' => 'thisIsNewMobileGame32;',
        'headers' => [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ],
    ],
    'template' => [
        'type' => 'twig',
        'path' => __DIR__ . '/../src/View/',
        'cache' => __DIR__ . '/../logs/'
    ]
];