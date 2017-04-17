@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">
		<h1>Kaikkien opettajien sessiot</h1>
			<hr>
		@foreach($sessios as $sessio)
			@include('sessios.sessio')
		@endforeach

	</div><!-- /.blog-main -->


@endsection