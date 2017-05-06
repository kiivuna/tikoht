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
	    $vastaus = $request->input('vastaus');
	    $op_vastaus = $request->input('op_vastaus');
	    $kyselytyyppi = $request->input('kyselytyyppi');
	    $tehtnro = $request->input('tehtnro');
	    $yr_nro = $request->input('yr_nro');
	    $ses_id = $request->input('ses_id');
	    $opisk_id = $request->input('opisk_id');
	    $teht_id = $request->input('teht_id');
	    if($yr_nro < 2){
		    if($yr_nro != -1 && $op_vastaus == ""){

				$yr_nro++;
		    	return redirect()->back()->withErrors([
	    			'message' => 'Yritä edes kirjoittaa jotain! Kokeile uudestaan.' 
	    		])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
		    }
		    else if($yr_nro != -1 && substr(preg_replace('/\s+/', '', $op_vastaus), -1) != ";"){
		    	$yr_nro++;
		    	return redirect()->back()->withErrors([
	    			'message' => 'Et kirjoittanut loppuun ; -merkkiä. Kokeile uudestaan.' 
	    		])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);	
		    }
		    else{
			    try {
				    //if($vastaus == $op_vastaus){
			    	if(strcasecmp($kyselytyyppi, 'delete') == 0 ){   //kirjaimen koolla ei valia
			    		if(strcasecmp(preg_replace('/\s+/', '', $vastaus), preg_replace('/\s+/', '', $op_vastaus)) == 0){
					    	$tehtnro++;
					    	$yr_nro = 0;
							return redirect()->back()->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', false);
			    		}
			    		else{
			    			$yr_nro++;
			    			return redirect()->back()->withErrors([
		    					'message' => 'Tehtävä meni väärin. Kokeile uudestaan.'
		    				])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
			    		}

			    	}
				    else if(strcasecmp($kyselytyyppi, 'select') == 0 ){
		          	   DB::beginTransaction();
		          	   $result = DB::select($vastaus);
		               DB::rollback();
		               DB::beginTransaction();
		               $yritys =  DB::select($op_vastaus);
		               DB::rollback();
		               if($yritys == $result){
		                  //return $op_vastaus;//back();
		                  # Pass the value while redirecting
		                  $tehtnro++;
		                  $yr_nro = 0;
		                  return redirect()->back()->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', false);
		               }
		               else{
							$yr_nro++;
							return redirect()->back()->withErrors([
								'message' => 'Tehtävä meni väärin. Kokeile uudestaan.'
							])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
							//echo dd($result[0]);
				    	
				    	}
		          }
		 		    else if(strcasecmp($kyselytyyppi, 'insert') == 0 ){
		          	   DB::beginTransaction();
		          	   $result = DB::insert($vastaus);
		               DB::rollback();
		               DB::beginTransaction();
		               $yritys =  DB::insert($op_vastaus);
		               DB::rollback();
		               if($yritys == $result){
		                  //return $op_vastaus;//back();
		                  # Pass the value while redirecting
		                  $tehtnro++;
		                  $yr_nro = 0;
		                  return redirect()->back()->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', false);
		               }
					    else{
					    	$yr_nro++;
			    			return redirect()->back()->withErrors([
								'message' => 'Tehtävä meni väärin. Kokeile uudestaan.'
							])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
					    	//echo dd($result[0]); 	
					    }

		          }
				    else{
				    	$yr_nro++;
		    			return redirect()->back()->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
				    	//echo dd($result[0]);
				    	
				    }
				    //echo $result[0]->id;

				} catch(\Illuminate\Database\QueryException $ex){ 
				  //dd($ex->getMessage()); 
				  // Note any method of class PDOException can be called on $ex.
					$yr_nro++;
				    return redirect()->back()->withErrors([
		    			'message' => 'Jotain meni pieleen syntaksissa. Kokeile uudestaan.'
		    		])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
				}
			}
		}
		else{
			if($yr_nro != -1 && $op_vastaus == ""){
				$vaarin_meni = true;
		    }
		    else if($yr_nro != -1 && substr(preg_replace('/\s+/', '', $op_vastaus), -1) != ";"){
				$vaarin_meni = true;
		    }
		    else{
			    try {
				    //if($vastaus == $op_vastaus){
			    	if(strcasecmp($kyselytyyppi, 'delete') == 0 ){   //kirjaimen koolla ei valia
			    		if(strcasecmp(preg_replace('/\s+/', '', $vastaus), preg_replace('/\s+/', '', $op_vastaus)) == 0){
							$vaarin_meni = false;
			    		}
			    		else{
							$vaarin_meni = true;
			    		}

			    	}
				    else if(strcasecmp($kyselytyyppi, 'select') == 0 ){
		          	   DB::beginTransaction();
		          	   $result = DB::select($vastaus);
		               DB::rollback();
		               DB::beginTransaction();
		               $yritys =  DB::select($op_vastaus);
		               DB::rollback();
		               if($yritys == $result){
		                  $vaarin_meni = false;
		               }
		               else{
							$vaarin_meni = true;
							//echo dd($result[0]);
				    	}
		          	}
		 		    else if(strcasecmp($kyselytyyppi, 'insert') == 0 ){
		          	   DB::beginTransaction();
		          	   $result = DB::insert($vastaus);
		               DB::rollback();
		               DB::beginTransaction();
		               $yritys =  DB::insert($op_vastaus);
		               DB::rollback();
		               if($yritys == $result){
		                  //return $op_vastaus;//back();
		                  # Pass the value while redirecting
						  $vaarin_meni = false;
		               }
					    else{
							$vaarin_meni = true;
					    	//echo dd($result[0]); 	
					    }

		          }
				    else{
				    	$vaarin_meni = true;
				    	//echo dd($result[0]);		    	
				    }
				    //echo $result[0]->id;

				} catch(\Illuminate\Database\QueryException $ex){ 
				  //dd($ex->getMessage()); 
				  // Note any method of class PDOException can be called on $ex.
					$vaarin_meni = true;
				}
			}

			if($vaarin_meni){
				$yr_nro = -1;
				$tehtnro++;
				return redirect()->back()->withErrors([
					'message' => 'Tehtävä meni väärin. Tässä esimerkkivastaus: '. $vastaus
				])->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', true);
			}
			else{
				$tehtnro++;
		        $yr_nro = 0;
                return redirect()->back()->with('saatunro', $tehtnro)->with('yrityskerta', $yr_nro)->with('vaarin_meni', false);	
			}

		}

	}


}
