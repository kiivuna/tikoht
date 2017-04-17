<?php

namespace App;

class Kurssi extends Model
{

    public function user()
    {
    	return $this->belongsTo('App\User');  //Post::class
    }
}
