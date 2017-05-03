<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kurssi;
use App\User;
use DB;


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

	public function save(Request $request)
	{   
		// https://laravel.com/docs/4.2/database#running-queries
	    //$data = $request->input();
	    //return $data;
	    //$result = DB::select(DB::raw("SELECT * FROM users"));
	    DB::beginTransaction();
	    $vastaus = $request->input('vastaus');
	    $op_vastaus = $request->input('op_vastaus');
	    $kyselytyyppi = $request->input('kyselytyyppi');
	    $tehtnro = $request->input('tehtnro');
	    try {
		    //if($vastaus == $op_vastaus){
	    	if(strcasecmp($kyselytyyppi, 'delete') == 0 ){   //kirjaimen koolla ei valia
	    		if(strcasecmp(preg_replace('/\s+/', '', $vastaus), preg_replace('/\s+/', '', $op_vastaus)) == 0){
			    	$tehtnro++;
					return redirect()->back()->with('saatunro', $tehtnro);
	    		}
	    		else{
	    			return redirect()->back()->withErrors([
    					'message' => 'Tehtävä meni väärin. Kokeile uudestaan.'
    				])->with('saatunro', $tehtnro);
	    		}

	    	}
		    else if(strcasecmp($kyselytyyppi, 'select') == 0 ){
          	   $result = DB::select($vastaus);
               DB::rollback();
               DB::beginTransaction();
               $yritys =  DB::select($op_vastaus);
               DB::rollback();
               if($yritys == $result){
                  DB::rollback();
                  //return $op_vastaus;//back();
                  # Pass the value while redirecting
                  $tehtnro++;
                  return redirect()->back()->with('saatunro', $tehtnro);
               }
          }
 		    else if(strcasecmp($kyselytyyppi, 'insert') == 0 ){
          	   $result = DB::insert($vastaus);
               DB::rollback();
               DB::beginTransaction();
               $yritys =  DB::insert($op_vastaus);
               DB::rollback();
               if($yritys == $result){
                  DB::rollback();
                  //return $op_vastaus;//back();
                  # Pass the value while redirecting
                  $tehtnro++;
                  return redirect()->back()->with('saatunro', $tehtnro);
               }
          }
		    else{
		    	DB::rollback();
    			return redirect()->back()->withErrors([
					'message' => 'Tehtävä meni väärin. Kokeile uudestaan.'
				])->with('saatunro', $tehtnro);
		    	//echo dd($result[0]);
		    	
		    }
		    //echo $result[0]->id;

		} catch(\Illuminate\Database\QueryException $ex){ 
		  //dd($ex->getMessage()); 
		  // Note any method of class PDOException can be called on $ex.
		     return redirect()->back()->withErrors([
    			'message' => 'Jotain meni pieleen syntaksissa. Kokeile uudestaan.'
    		])->with('saatunro', $tehtnro);
		}

	}


}
