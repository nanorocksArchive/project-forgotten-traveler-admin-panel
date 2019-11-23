<?php

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;

$capsule = new DB;
$config = require_once __DIR__ . '/../../src/config.php';

try{
    $capsule->addConnection($config['db']);
}catch (Exception $e)
{
    die('There is a problem with db connection.');
}

$capsule->setAsGlobal();