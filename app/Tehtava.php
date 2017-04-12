<?php

namespace App;

class Tehtava extends Model
{
    public function tehtavalista()
    {
    	return $this->belongsTo('App\Tehtavalista');  //Post::class
    }

    public function user()
    {
    	return $this->belongsTo('App\User');  //Post::class
    }
}
