@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opiskelijat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))

	@section('content')

      <div class="starter-template">
        <h1>Kurssin <i>{{ $kurssi->nimi }}</i> sessiot</h1>
      </div>

		<div class="col-sm-8 blog-main">
		
				@foreach (DB::table('sessios')->having('kurssi_id', $kurssi->id)->groupBy('id')->get() as $kurssisessiot)
				<a href="/kurssit/sessiot/{{ $kurssisessiot->id}}">
					{{ DB::table('tehtavalistas')->having('id', $kurssisessiot->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus }}
				</a>
				</br>
				@endforeach	
	
				</br>	   
		</div>

	@endsection
@endif
