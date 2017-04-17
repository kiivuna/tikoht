@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))
	@section('content')
		<div class="col-sm-8 blog-main">
			<h1>Luo tehtävälista</h1>

			<hr>

			<form method="POST" action="/tehtavalistas">

			  {{ csrf_field() }}

			  <div class="form-group">
			    <label for="tehtlista_kuvaus">Anna tehtävälistan kuvaus</label>
			    <input type="text" class="form-control" id="tehtlista_kuvaus" name="tehtlista_kuvaus" required>
			  </div>

			  <div class="form-group">
			  	<button type="submit" class="btn btn-primary">Luo tehtävälista</button>
			  </div>

			  @include('layouts.errors')

			</form>
		</div>
	@endsection
@endif