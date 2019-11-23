<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

    protected $connection = 'mysql';

    protected $table='users';

    protected $fillable = ['email', 'username'];
}