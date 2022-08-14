<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmGenre extends Model
{
	protected $table = 'film_genre';
	public $timestamps = false;
    protected $fillable = ['film_id', 'genre_id'];
}
