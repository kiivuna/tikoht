@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">

		<h1> {{ $tehtavalista->tehtlista_kuvaus }} </h1>
		Tekijä: 
		<b>{{ App\User::find($tehtavalista->tehtlista_luoja_id)->name }} </b>
	    </br>
	    päiväys: 
	    <i>{{ $tehtavalista->created_at->toFormattedDateString() }} </i>

 		</br>
	    Tehtävät:
	    @include('tehtavas.show')
		
		</br>
	    @if(Auth::check())
			@include('tehtavas.create')
		@endif
	</div>

@endsection