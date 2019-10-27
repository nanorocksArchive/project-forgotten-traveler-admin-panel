<?php

require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../src/config.php';

$app = new \Slim\App(['settings' => $config]);

require_once __DIR__ . '/../src/dependence.php';

require_once __DIR__ . '/../src/route/api.php';

$app->run();