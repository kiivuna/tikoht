@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))
	@section('content')
		<div class="col-sm-8 blog-main">
			<h1>Muokkaa sessiota</h1>

			<hr>

			<form method="POST" action="/sessios/{{ $sessio->id }}/edit">

			  {{ csrf_field() }}

			  <div class="form-group">
			    <label for="kurssi_id">Valitse kurssi:</label>
			    </br>
					<select name="kurssi_id">
						<option value="">Select...</option>
						@if(Auth::check() && Auth::user()->isAdmin())
							@foreach (DB::table('kurssis')->groupBy('id')->get() as $kurssi)
								<option value="{{ $kurssi->id }}">{{ $kurssi->nimi }}</option>
							@endforeach
						@else
							@foreach (DB::table('kurssis')->having('opettaja_id', Auth::user()->id)->groupBy('id')->get() as $kurssi)
								<option value="{{ $kurssi->id }}">{{ $kurssi->nimi }}</option>
							@endforeach
						@endif
					</select>
			  </div>

			  <div class="form-group">
			    <label for="tehtlista_id">Valitse tehtävälista:</label>
			    </br>
			    	<select name="tehtlista_id">
						<option value="">Select...</option>
							@foreach (DB::table('tehtavalistas')->groupBy('id')->get() as $tehtlista)
								<option value="{{ $tehtlista->id }}">{{ $tehtlista->tehtlista_kuvaus }}</option>
							@endforeach
					</select>
			  </div>

			  <div class="form-group">
			  	<button type="submit" class="btn btn-primary">Päivitä sessio</button>
			  </div>

			  @include('layouts.errors')

			</form>
		</div>
	@endsection
@endif