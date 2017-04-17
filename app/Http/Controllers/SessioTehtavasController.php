<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sessio;
use App\SessioTehtava;
use App\User;


class SessioTehtavasController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth')->except(['show']);
	}


	 public function show(SessioTehtava $sessiotehtava)  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
    	//$post = Post::find($id);
	    return view('sessiotehtavas.show', compact('sessiotehtava'));
    }

    public function create()  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
	    return view('sessiotehtavas.create');
    }

}
