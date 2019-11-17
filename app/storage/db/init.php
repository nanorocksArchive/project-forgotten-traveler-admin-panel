<?php

$config = require_once __DIR__ . '/../../src/config.php';

require_once __DIR__ . '/class/Database.php';

$db = new Database(
    $config['db']['drive'],
    __DIR__,
    $config['db']['filename']
);

// To recreate db
if ($db->DbExist())
{
    $db->deleteDB();
    $db->createDB();
}

$db->setConnection();

// Migrations here
$users = require_once __DIR__ . '/../migration/usersMigration.php';
$levels = require_once __DIR__ . '/../migration/levelsMigration.php';
$scores = require_once __DIR__ . '/../migration/scoresMigration.php';

// Create tables
$db->createTable($users, 'users');
$db->createTable($levels, 'levels');
$db->createTable($scores, 'scores');