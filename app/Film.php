<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    
	protected $guarded = ['id'];
    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }
    
    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
