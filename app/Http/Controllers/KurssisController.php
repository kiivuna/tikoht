<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kurssi;
use App\User;


class KurssisController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth')->except(['show']);
	}


	 public function show(Kurssi $kurssi)  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
    	//$post = Post::find($id);
	    return view('kurssis.show', compact('kurssi'));
    }


}
