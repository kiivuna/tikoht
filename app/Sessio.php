<?php

namespace App;

use Carbon\Carbon;

class Sessio extends Model
{
   public function sessiotehtavas()
   {
      return $this->hasMany('App\SessioTehtava');  //Comment::class php 5.5->
   }


   public function user()
   {
    	return $this->belongsTo('App\User');  //Post::class
   }

   public function addSessioTehtava(Sessio $sessio)
   {
      //$teht_luoja_id = auth()->id();
      //$this->tehtavas()->create(compact(
      //  'teht_kuvaus', 
      //  'esim_vastaus',
      //  'kysely_tyyppi', 
      //  'teht_luoja_id'
      //));
      $this->sessiotehtavas()->create([
         //   'teht_kuvaus' => request('teht_kuvaus'),
          //  'esim_vastaus' => request('esim_vastaus'),
          //  'kysely_tyyppi' => request('kysely_tyyppi'),
          //  'teht_luoja_id' => auth()->id()
            //'body' => request('body'),
            //'user_id' => auth()->id()
      ]);

   }

   public function scopeFilter($query, $filters)
   {
      if($month = $filters['month']){
        $query->whereMonth('created_at', Carbon::parse($month)->month);
      }

        if($year = $filters['year']){
        $query->whereYear('created_at', $year);
      }
    
    //$posts = $posts->get();
   }

}