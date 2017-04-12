@extends('layouts.master')


@section('content')

	<div class="col-sm-8 blog-main">
		@foreach($tehtavalistas as $tehtavalista)
			@include('tehtavalistas.tehtavalista')
		@endforeach

	</div><!-- /.blog-main -->


@endsection