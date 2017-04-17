@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">
		<h1>Omat sessiot</h1>
	    <hr>
		@foreach($sessios as $sessio)
			@if( Auth::check() && (Auth::user()->id == $sessio->session_luoja_id) )
				@include('sessios.sessio')
			@endif
		@endforeach

	</div><!-- /.blog-main -->


@endsection



