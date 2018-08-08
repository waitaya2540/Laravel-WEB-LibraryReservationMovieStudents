<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'movie_code',
        'movie_name',
    ];

    public function type() {
        return $this->belongsToMany('App\Type', 'movie_type');
    }

    public function onAir() {
        return $this->hasOne('App\OnAir', 'movie_id');
    }

}