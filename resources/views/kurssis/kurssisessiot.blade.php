@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opiskelijat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))

  @section('content')

    <div class="starter-template">
        <h1>Session <i>{{DB::table('tehtavalistas')->having('id', $sessio->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus}}</i> tehtävät</h1>
    </div>

    <div class="col-sm-8 blog-main">
    
        @foreach (DB::table('tehtavas')->having('tehtavalista_id', $sessio->tehtlista_id)->groupBy('id')->get() as $teht)
          <li class="list-group-item">
            Tehtävän kuvaus: 
            {{ $teht->teht_kuvaus }}
            </br>
            Tehtävän esimerkkivastaus:
            {{ $teht->esim_vastaus }}
            </br>
            Tehtävän kyselytyyppi:
            {{ $teht->kysely_tyyppi }}
          </li>
        @endforeach 
  
        </br>    
    </div>

  @endsection
@endif