<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
   //protected $fillable = ['title', 'body'];  //massasignmentexception, fillable white list, guarded black list
    protected $guarded = [];
}