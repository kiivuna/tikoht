@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))

	@section('content')

		<div class="col-sm-8 blog-main">

			<h1> {{ $tehtavalista->tehtlista_kuvaus }} </h1>
			Tekijä: 
			<b>{{ App\User::find($tehtavalista->tehtlista_luoja_id)->name }} </b>
		    </br>
		    päiväys: 
		    <i>{{ $tehtavalista->created_at->toFormattedDateString() }} </i>
			@include('tehtavalistas.delete')
	 		</br>
		    Tehtävät:
		    @include('tehtavas.show')
			
			</br>
		    @if(Auth::check() && ((Auth::user()->id == App\User::find($tehtavalista->tehtlista_luoja_id)->id) || Auth::user()->isAdmin()))
				@include('tehtavas.create')
			@endif
		</div>

	@endsection
@endif