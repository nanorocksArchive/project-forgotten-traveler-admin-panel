<?php

require_once __DIR__ . '/init.php';

use Illuminate\Database\Capsule\Manager as DB;

// Migration here
DB::schema()->create('admins', function ($table) {
    $table->increments('id')->index();
    $table->string('email')->unique();
    $table->string('password', 255);
    $table->timestamps();
});

DB::schema()->create('users', function ($table) {
    $table->increments('id')->index();
    $table->string('email')->unique();
    $table->string('username')->unique();
    $table->string('password', 255);
    $table->string('total_time');
    $table->string('activation')->default(null);
    $table->timestamps();
});

DB::schema()->create('forgot_password', function ($table) {
    $table->increments('id_user')->unsigned()->index();
    $table->string('reset')->default(null);
    $table->timestamps();
    $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
});

DB::schema()->create('levels', function ($table) {
    $table->increments('id')->index();
    $table->string('name');
    $table->integer('total_stars');
    $table->integer('total_coins');
});

DB::schema()->create('scores', function ($table) {
    $table->integer('id_user')->unsigned()->index();
    $table->integer('id_level')->unsigned()->index();
    $table->integer('coins')->default(0);
    $table->integer('stars')->default(0);
    $table->string('time');
    $table->timestamps();
    $table->primary(['id_user', 'id_level']);
    $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('id_level')->references('id')->on('levels')->onDelete('cascade')->onUpdate('cascade');
});

die("\nMigrations done. Check DB.\n");