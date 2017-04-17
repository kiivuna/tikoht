@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opiskelijat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))

	@section('content')

      <div class="starter-template">
        <h1>Omat kurssit</h1>
      </div>
		<div class="col-sm-8 blog-main">
			@if(Auth::check() && Auth::user()->isAdmin())
				@foreach (DB::table('kurssinOsallistujat')->groupBy('kurssi_id', 'op_id')->get() as $kurssi)
					<a href="/kurssit/{{ $kurssi->kurssi_id }}">
						{{ DB::table('kurssis')->having('id', $kurssi->kurssi_id)->groupBy('id')->first()->nimi }}
					</a>
					</br>
				@endforeach	
			@else

			@foreach (DB::table('kurssinOsallistujat')->having('op_id', Auth::user()->id)->groupBy('kurssi_id', 'op_id')->get() as $kurssi)
				<a href="/kurssit/{{ $kurssi->kurssi_id }}">
					{{ DB::table('kurssis')->having('id', $kurssi->kurssi_id)->groupBy('id')->first()->nimi }}
				</a>
				</br>
			@endforeach	

			@endif	   
		</div>

	@endsection
@endif


