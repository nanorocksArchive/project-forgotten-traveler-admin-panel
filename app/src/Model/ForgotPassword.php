<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ForgotPassword extends Eloquent {

    /**
     * @var string
     */
    protected $table='forgot_password';

    /**
     * @var array
     */
    protected $hidden = ['reset'];

    /**
     * @var string
     */
    protected $primaryKey = 'id_user';
}