<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ForgotPassword extends Eloquent {

    protected $table='forgot_password';

    protected $hidden = ['reset'];

    protected $primaryKey = 'id_user';
}