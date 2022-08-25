<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmGenre extends Model
{
	// Specify the table name
	protected $table = 'film_genre';

	// Disabled default timestamp columns
	public $timestamps = false;
	// Only those field insert in table which is declared in fillable property
    protected $fillable = ['film_id', 'genre_id'];
}
