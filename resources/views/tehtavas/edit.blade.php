@extends('layouts.master')
	@section('content')
		<div class="card">
			<div class="card-block">
				@if(Auth::check() && ((Auth::user()->id == App\User::find($tehtava->teht_luoja_id)->id) || Auth::user()->isAdmin()))
				<h1>Muokkaa tehtävää </h1>

				<form method="POST" action="/tehtavas/{{ $tehtava->id }}/edit">

				  {{ csrf_field() }}

				  <div class="form-group">
				    <label for="teht_kuvaus">Anna tehtävän kuvaus</label>
				    <input type="text" class="form-control" id="teht_kuvaus" name="teht_kuvaus" value= "{{ $tehtava->teht_kuvaus }}" required>
				  </div>

				  <div class="form-group">
				    <label for="esim_vastaus">Anna esimerkkivastaus</label>
				    <input type="text" class="form-control" id="esim_vastaus" name="esim_vastaus" value= "{{ $tehtava->esim_vastaus }}" required>
				  </div>

				  <div class="form-group">
				    <label for="kysely_tyyppi">Anna kyselyn tyyppi</label>
				    <input type="text" class="form-control" id="kysely_tyyppi" name="kysely_tyyppi" value= "{{ $tehtava->kysely_tyyppi }}" required>
				  </div>

				  <div class="form-group">
				  	<button type="submit" class="btn btn-primary">Muokkaa tehtäväa</button>
				  </div>


				  @include('layouts.errors')

				</form>
				@endif
			</div>
		@endsection

</div>