<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function movie() {
        return $this->belongsToMany('App\Movie', 'movie_type');
    }
}
