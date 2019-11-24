<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Level extends Model {

    protected $table = 'levels';

    protected $primaryKey = 'id';

    public $timestamps = false;
}