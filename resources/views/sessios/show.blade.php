@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))

	@section('content')

		<div class="col-sm-8 blog-main">

			<h1>Kurssille <i>{{ DB::table('kurssis')->having('id', $sessio->kurssi_id)->groupBy('id')->first()->nimi }} </i> tehtävälista <i> {{ DB::table('tehtavalistas')->having('id', $sessio->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus }} </i> </h1>
			Kurssi: 
			<i>{{ DB::table('kurssis')->having('id', $sessio->kurssi_id)->groupBy('id')->first()->nimi }}</i>
		    </br>
		    Tehtävälista: 
		    <i>{{ DB::table('tehtavalistas')->having('id', $sessio->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus }}</i>
			</br>
			Tekijä: 
			<b>{{ App\User::find($sessio->session_luoja_id)->name }} </b>
		    </br>
		    päiväys: 
		    <b>{{ $sessio->created_at->toFormattedDateString() }} </b>
			@include('sessios.delete')
	 		</br>
		    Tehtävälistaan kuuluvat tehtävät:
			@include('sessiotehtavas.show')
		   
		</div>

	@endsection
@endif