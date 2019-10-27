<?php

return [
    'displayErrorDetails' => true,
    'addContentLengthHeader'=> false,
    'db' => [
        'type' => 'sqlite',
        'filename' => 'database.db'
    ],
    'logs' => [
        'error' => __DIR__ . '/../logs/error.log',
        'database' => __DIR__ . '/../logs/database.log'
    ]
];