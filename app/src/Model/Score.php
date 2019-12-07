<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Score extends Model {

    protected $table = 'scores';

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('id_user', '=', $this->getAttribute('id_user'))
            ->where('id_level', '=', $this->getAttribute('id_level'));
        return $query;
    }
}