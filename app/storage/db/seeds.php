<?php

require_once __DIR__ . '/init.php';

use Illuminate\Database\Capsule\Manager as DB;

// admins
DB::table('admins')->insert([
    'email' => 'andrejnankov@gmail.com',
    'password' => md5('confusionsnake32;'),
]);

// users
DB::table('users')->insert([
    'email' => 'andrejnankov@gmail.com',
    'username' => 'nanorocks',
    'password' => md5('andrej123'),
    'total_time' => '0',
    'activation' => '1'
]);

DB::table('users')->insert([
    'email' => 'babic@gmail.com',
    'username' => 'babic123',
    'password' => md5('babic321'),
    'total_time' => '0',
    'activation' => '1'
]);

DB::table('users')->insert([
    'email' => 'filip@gmail.com',
    'username' => 'filip20',
    'password' => md5('filip123'),
    'total_time' => '0',
    'activation' => '1'
]);

// --------------------------------------

// levels
for ($i = 1; $i<=7; $i++):

    DB::table('levels')->insert([
        'name' => 'level ' . $i,
        'total_stars' => random_int(61, 100),
        'total_coins' => random_int(44, 100),
    ]);

endfor;

// scores
$usersIds = DB::table('users')->pluck('id')->toArray();
$levelsIds = DB::table('levels')->pluck('id')->toArray();

for ($i = 0; $i<7; $i++):

    $uIdK = array_rand($usersIds);
    $lIdK = array_rand($levelsIds);

    DB::table('scores')->insert([
        'id_user' => $usersIds[$uIdK],
        'id_level' => $levelsIds[$lIdK],
        'coins' => random_int(1,61),
        'stars' => random_int(1,44),
        'time' => date('i:s', mt_rand(1,time()))
    ]);

    //unset($usersIds[$uIdK]);
    unset($levelsIds[$lIdK]);

endfor;

die("\nSeeds done. Check DB.\n");
