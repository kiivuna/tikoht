<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sessio;
use App\User;

class SessiosController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth')->except(['index', 'show']);
	}


    public function index()
    {
    	$sessios = Sessio::latest() //Tehtavalista::orderBy('created_at', 'desc') //Tehtavalista::latest() //Post::orderBy('created_at', 'desc');  //latest()->get()
    		->filter(request(['month', 'year']))
    		->get();

    	return view('sessios.index', compact('sessios'));
    }

    public function show(Sessio $sessio)  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
    	//$post = Post::find($id);
	    return view('sessios.show', compact('sessio'));
    }

    public function showsessiot(Sessio $sessio)  //Task::find(wildcard);
    {
        //return $task;
        //dd($id);
       //$task = DB::table('tasks')->find($id);
        //$task = Task::find($id);
        //dd($sessio);
        //$post = Post::find($id);
        return view('kurssis.kurssisessiot', compact('sessio'));
    }

    public function create()  //Task::find(wildcard);
    {
    	//return $task;
    	//dd($id);
	   //$task = DB::table('tasks')->find($id);
		//$task = Task::find($id);
	   //dd($tasks);
	    return view('sessios.create');
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
    		'tehtlista_id' => 'required',
            'kurssi_id' => 'required',

    	]);

        $sessio = new Sessio(request(['tehtlista_id', 'kurssi_id',]));

    	auth()->user()->publishSessio(
    		//new Tehtavalista(request(['tehtlista_kuvaus', ]))
            $sessio
    	);

    	//massassignmentexception
        //$tehtavalista->id = request('id');
    	//And then redirect to the home page.
        //return redirect('/');
        //return view('tehtavalistas.show', $tehtavalista);
        // For a route with the following URI: profile/{id}
        return redirect()->action(
            'SessiosController@show', ['id' => Sessio::all()->last()->id]
        );
    }

    public function destroy($id)
    {
        $sessio = Sessio::findOrFail($id)->delete();

        return redirect('/');

    }

    public function edit($id)
    {
        $sessio = Sessio::find($id);

        return view('sessios.edit', compact('sessio'));

    }

    public function update($id)
    {
        
        $this->validate(request(), [
            'tehtlista_id' => 'required',
            'kurssi_id' => 'required',
        ]);

        $sessio = Sessio::findOrFail($id);
        $sessio->tehtlista_id = request('tehtlista_id');
        $sessio->kurssi_id = request('kurssi_id');
        $user = User::findOrFail($sessio->session_luoja_id);
        //$user->publish($tehtavalista);
        $sessio->save();

        //return redirect('/');
        return redirect()->action(
            'SessiosController@show', ['id' => $id]
        );

    }

    public function omat()  //Task::find(wildcard);
    {
        $sessios = Sessio::latest() //Tehtavalista::orderBy('created_at', 'desc') //Tehtavalista::latest() //Post::orderBy('created_at', 'desc');  //latest()->get()
            ->filter(request(['month', 'year']))
            ->get();

        return view('sessios.omat', compact('sessios'));
    }

}

