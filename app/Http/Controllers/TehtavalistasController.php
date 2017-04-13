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

        $tehtavalista = new Tehtavalista(request(['tehtlista_kuvaus', ]));

    	auth()->user()->publish(
    		//new Tehtavalista(request(['tehtlista_kuvaus', ]))
            $tehtavalista
    	);

    	//massassignmentexception
        //$tehtavalista->id = request('id');
    	//And then redirect to the home page.
        //return redirect('/');
        //return view('tehtavalistas.show', $tehtavalista);
        // For a route with the following URI: profile/{id}
        return redirect()->action(
            'TehtavalistasController@show', ['id' => Tehtavalista::all()->last()->id]
        );
    }

    public function destroy($id)
    {
        $tehtavalista = Tehtavalista::findOrFail($id)->delete();

        return redirect('/');

    }

    public function edit($id)
    {
        $tehtavalista = Tehtavalista::find($id);

        return view('tehtavalistas.edit', compact('tehtavalista'));

    }

    public function update($id)
    {
        
        $this->validate(request(), [
            'tehtlista_kuvaus' => 'required',
        ]);

        $tehtavalista = Tehtavalista::findOrFail($id);
        $tehtavalista->tehtlista_kuvaus = request('tehtlista_kuvaus');
        $user = User::findOrFail($tehtavalista->tehtlista_luoja_id);
        //$user->publish($tehtavalista);
        $tehtavalista->save();

        //return redirect('/');
        return redirect()->action(
            'TehtavalistasController@show', ['id' => $id]
        );

    }

    public function omat()  //Task::find(wildcard);
    {
        $tehtavalistas = Tehtavalista::latest() //Tehtavalista::orderBy('created_at', 'desc') //Tehtavalista::latest() //Post::orderBy('created_at', 'desc');  //latest()->get()
            ->filter(request(['month', 'year']))
            ->get();

        return view('tehtavalistas.omat', compact('tehtavalistas'));
    }

}

