<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Score extends Model {

    /**
     * @var string
     */
    protected $table = 'scores';

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('id_user', '=', $this->getAttribute('id_user'))
            ->where('id_level', '=', $this->getAttribute('id_level'));
        return $query;
    }
}