<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function tehtavalistas()
    {
        return $this->hasMany('App\Tehtavalista');
    }

    public function publish(Tehtavalista $tehtavalista)
    {
       //$this->tehtavalistas()->save($tehtavalista);
        Tehtavalista::create([
            'tehtlista_kuvaus' => request('tehtlista_kuvaus'),
            'tehtlista_luoja_id' => auth()->id()
            //'body' => request('body'),
            //'user_id' => auth()->id()
       ]);

    }

    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }

}
