<?php

// add monolog to container
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('request_logger');
    $file_handler = new \Monolog\Handler\StreamHandler( __DIR__ . '/../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};
