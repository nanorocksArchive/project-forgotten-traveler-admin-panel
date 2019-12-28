<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

    /**
     * @var string
     */
    protected $table='admins';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'email', 'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}