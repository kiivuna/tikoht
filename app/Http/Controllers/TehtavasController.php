<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tehtavalista;
use App\Tehtava;
use App\User;


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

    public function destroy($id)
    {
        $tehtava = Tehtava::findOrFail($id)->delete();

        return back();

    }

    public function edit($id)
    {
        $tehtava = Tehtava::find($id);

        return view('tehtavas.edit', compact('tehtava'));

    }

    public function update($id)
    {
        
        $this->validate(request(), [
            'teht_kuvaus' => 'required',
            'esim_vastaus' => 'required',
            'kysely_tyyppi' => 'required'

        ]);

        $tehtava = Tehtava::findOrFail($id);
        $tehtava->teht_kuvaus = request('teht_kuvaus');
        $tehtava->esim_vastaus = request('esim_vastaus');
        $tehtava->kysely_tyyppi = request('kysely_tyyppi');
        $user = User::findOrFail($tehtava->teht_luoja_id);
        //$user->publish($tehtavalista);
        $tehtava->save();

        //return redirect('/');
        //return back();
        return redirect()->action(
            'TehtavalistasController@show', ['id' => $tehtava->tehtavalista_id]
        );

    }


}
