@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">
		@foreach($tehtavalistas as $tehtavalista)
			@if( Auth::check() && (Auth::user()->id == $tehtavalista->tehtlista_luoja_id) )
				@include('tehtavalistas.tehtavalista')
			@endif
		@endforeach

	</div><!-- /.blog-main -->


@endsection



