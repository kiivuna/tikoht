<?php

namespace App;

class SessioTehtava extends Model
{
    public function sessio()
    {
    	return $this->belongsTo('App\Sessio');  //Post::class
    }

    public function user()
    {
    	return $this->belongsTo('App\User');  //Post::class
    }
}
