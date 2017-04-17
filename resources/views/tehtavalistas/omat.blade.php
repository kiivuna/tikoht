@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">
		<h1>Omat tehtävälistat</h1>
		<hr>
		@foreach($tehtavalistas as $tehtavalista)
			@if( Auth::check() && (Auth::user()->id == $tehtavalista->tehtlista_luoja_id) )
				@include('tehtavalistas.tehtavalista')
			@endif
		@endforeach

	</div><!-- /.blog-main -->


@endsection



