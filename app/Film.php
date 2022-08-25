<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // Only those field insert in table which is declared in fillable property
	protected $fillable = ['name', 'slug', 'description', 'release_date', 'rating', 'ticket_price', 'country_id', 'photo'];

    // Get film's genres
    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }
    
    // Override the release_date field value
    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    // Get the film's country by relationship
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    // Get the comments for films 
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
