<?php

/**
 * Run this code only once on fresh setup
 * ---------------------------------------
 */

$execProcedures = [
    'composer' => [
        'install' => 'composer install',
        'autoload' => 'composer dump-autoload -o'
    ],
    'logs' => [
        'dir' => '[ -d logs ] || mkdir logs',
        'database' => 'touch logs/database.log',
        'errors' => 'touch logs/error.log'
    ]

];

$reports = [];

// Setup composer
$reports[] = shell_exec($execProcedures['composer']['install']);
$reports[] = shell_exec($execProcedures['composer']['autoload']);

// Setup logs
$reports[] = shell_exec($execProcedures['logs']['dir']);
$reports[] = shell_exec($execProcedures['logs']['database']);
$reports[] = shell_exec($execProcedures['logs']['errors']);

foreach ($reports as $report) {
    echo $report;
}

// Prepare db first time
require_once __DIR__ . '/storage/db/init.php';