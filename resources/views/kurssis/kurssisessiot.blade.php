@extends('layouts.master')

@if(Auth::check() && ( !empty( DB::table('opiskelijat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))

  @section('content')

    <div class="starter-template">
        <h1>Session <i>{{DB::table('tehtavalistas')->having('id', $sessio->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus}}</i> tehtävät</h1>
    </div>

    <div class="col-sm-8 blog-main">
    
    <?php
        $tehtavat = DB::select(DB::raw("SELECT * FROM tehtavas WHERE tehtavalista_id = ? GROUP BY id"), array($sessio->tehtlista_id));
    ?>

    @if(!isset($nro))
        <?php
            $teht = reset($tehtavat);
            //echo 'hei';//session('tab');
            $nro = 0;
        ?>
    @endif
        
    <?php
    $nro = intval(session('saatunro'));
    //echo session('nro');
    //$teht = next($tehtavat);
    ?>

    @if(isset($tehtavat[$nro]))
        <?php
            $teht = $tehtavat[$nro];
        ?>

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


            <form class="form-horizontal" role="form" method="POST" action="{{ url('saveproduct') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-md-4 control-label">Anna vastaus</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="op_vastaus"  id="op_vastaus" value="">
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="vastaus" id="vastaus" value="{{ $teht->esim_vastaus  }}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="kyselytyyppi" id="kyselytyyppi" value="{{ $teht->kysely_tyyppi  }}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="tehtnro" id="tehtnro" value="{{ $nro  }}">
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">
                            Vastaa
                        </button>
                    </div>
                </div>
                @include('layouts.errors')
            </form>

    @else
        <a class="" href='/kurssit'>Loppu! Palaa Omat kurssit -sivulle</a>

    @endif
  
    </div>


  @endsection
@endif