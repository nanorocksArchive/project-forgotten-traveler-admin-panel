<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Level extends Model {

    /**
     * @var string
     */
    protected $table = 'levels';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;
}