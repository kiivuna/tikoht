<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tehtavalista;
use App\User;

class TehtavalistasController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth')->except(['index', 'show']);
	}


    public function index()
    {
    	$tehtavalistas = Tehtavalista::latest() //Tehtavalista::orderBy('created_at', 'desc') //Tehtavalista::latest() //Post::orderBy('created_at', 'desc');  //latest()->get()
    		->filter(request(['month', 'year']))
    		->get();

    	return view('tehtavalistas.index', compact('tehtavalistas'));
    }

    public function show(Tehtavalista $tehtavalista)  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
    	//$post = Post::find($id);
	    return view('tehtavalistas.show', compact('tehtavalista'));
    }

    public function create()  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
	    return view('tehtavalistas.create');
    }

    public function store()
    {
    	//dd(request('title'));
    	//Create a new post using the request data
    	//$post = new Post;

    	//$post->title = request('title');
    	//$post->body = request('body');

    	//Save it to the database
    	//$post->save();
    	$this->validate(request(), [
    		'tehtlista_kuvaus' => 'required',

    	]);

    	auth()->user()->publish(
    		new Tehtavalista(request(['tehtlista_kuvaus', ]))
    	);

    	//massassignmentexception

    	//And then redirect to the home page.
    	return redirect('/');
    }

}

