@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">
		<h1>Kaikkien opettajien tehtävälistat</h1>
		<hr>
		@foreach($tehtavalistas as $tehtavalista)
			@include('tehtavalistas.tehtavalista')
		@endforeach

	</div><!-- /.blog-main -->


@endsection