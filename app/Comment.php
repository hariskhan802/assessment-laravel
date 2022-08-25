<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    // Only those field insert in table which is declared in fillable property
	protected $fillable = ['comment', 'user_id', 'film_id'];

	// Get the comment's user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
