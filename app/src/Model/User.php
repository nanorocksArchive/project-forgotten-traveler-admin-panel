<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

    /**
     * @var string
     */
    protected $table='users';

    /**
     * @var array
     */
    protected $fillable = ['email', 'username'];

    /**
     * @var array
     */
    protected $hidden = ['password'];
}