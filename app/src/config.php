<?php

return [
    'displayErrorDetails' => true,
    'addContentLengthHeader'=> false,
    'db' => [
        'driver' => 'mysql',
        'host' => '107.189.6.84',
        'database' => 'nankovmk_ftraveler_dev',
        'username' => 'nankovmk_ftraveler',
        'password' => 'iOYYjW!0jaR_nK+tKi',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
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
    ],
    'mail' => [
        'senderName' => 'Forgotten Traveler',
        'senderEmail' => 'mail@ftadmin.php.mk',
        'customId' => 'thisIsNewMobileGame32;',
        'key' => 'd813129af503e903ff40fae06f65e57f',
        'secret' => '18c50ea2fb82dde307d66a0ef3460604',
        'call' => true,
        'version' => ['version' => 'v3.1']
    ]
];