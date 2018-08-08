<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnAir extends Model
{
    protected $table = 'on_airs';
    protected $primaryKey = 'id';

    public function movie() {
        return $this->belongsTo('App\Movie', 'movie_id', 'id');
    }
}
