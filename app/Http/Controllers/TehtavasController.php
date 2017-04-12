<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tehtavalista;
use App\Tehtava;

class TehtavasController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth')->except(['show']);
	}


	 public function show(Tehtava $tehtava)  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
    	//$post = Post::find($id);
	    return view('tehtavas.show', compact('tehtava'));
    }

    public function create()  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
	    return view('tehtavas.create');
    }


    public function store(Tehtavalista $tehtavalista)
    {

    	$this->validate(request(), [
            'teht_kuvaus' => 'required',
            'esim_vastaus' => 'required',
            'kysely_tyyppi' => 'required'

        ]);
    	//auth()->user()->addComment(new Post(request(['body'])));
    	$tehtavalista->addTehtava(new Tehtavalista(request(['teht_kuvaus', 'esim_vastaus', 'kysely_tyyppi']), $tehtavalista));
    	return back();

    }

}
