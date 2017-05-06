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
    $yr_nro = intval(session('yrityskerta'));
    $vaara = session('vaarin_meni');
    //echo session('nro');
    //$teht = next($tehtavat);
    ?>


    @if(isset($tehtavat[$nro]))
        <?php
            //$sessio->id
            //Auth::user()->id
            //$tehtavat->id
            $teht = $tehtavat[$nro];
            $kerta = $yr_nro+1;
            $tehtavan_nro = $nro +1;

        ?>
        @if($kerta != 0)
            @if(!empty( DB::table('sessiotehtavas')->orderBy('aloitus_hetki', 'desc')->first() ))
                <?php
                    $taulu = DB::table('sessiotehtavas')->orderBy('aloitus_hetki', 'desc')->first();
                    DB::table('sessiotehtavas')
                        ->where([
                            'sessio_id' => $taulu->sessio_id, 
                            'op_id' => $taulu->op_id,
                            't_id' => $taulu->t_id,
                            'yritys' => $taulu->yritys     
                        ])
                        ->update([
                            'lopetus_hetki' => DB::raw('now()'),
                            'oikein' => !($vaara)
                        ]);
                ?>
            @endif
            <?php
                DB::table('sessiotehtavas')->insert([
                    'sessio_id' => $sessio->id, 
                    'op_id' => Auth::user()->id,
                    't_id' => $teht->id,
                    'aloitus_hetki' => DB::raw('now()'),
                    'yritys' => $kerta
                ]);
            ?>
        @endif


        @if($yr_nro == -1 && $vaara)
            @if(!empty( DB::table('sessiotehtavas')->orderBy('aloitus_hetki', 'desc')->first() ))
                <?php
                    $taulu = DB::table('sessiotehtavas')->orderBy('aloitus_hetki', 'desc')->first();
                    DB::table('sessiotehtavas')
                        ->where([
                            'sessio_id' => $taulu->sessio_id, 
                            'op_id' => $taulu->op_id,
                            't_id' => $taulu->t_id,
                            'yritys' => $taulu->yritys     
                        ])
                        ->update([
                            'lopetus_hetki' => DB::raw('now()'),
                            'oikein' => !($vaara)
                        ]);
                ?>
            @endif

          <li class="list-group-item">
            Tietokannan taulut:
          </li>
            <img style="width:95px;height:111px" src="http://wiki.scratch.mit.edu/w/images/Scratch_Cat.png" alt="Scratch-klubi" />
          <li class="list-group-item">
            Tehtävä meni väärin. Tässä esimerkkivastaus:
            </br>
            {{ $tehtavat[$nro-1]->esim_vastaus }}
          </li>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('saveproduct') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" class="form-control" name="tehtnro" id="tehtnro" value="{{ $nro  }}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="yr_nro" id="yr_nro" value="{{ $yr_nro  }}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="ses_id" id="ses_id" value="{{ $sessio->id }}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="opisk_id" id="opisk_id" value="{{ Auth::user()->id }}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="teht_id" id="teht_id" value="{{ $teht->id }}">
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">
                            Jatka seuraavaan tehtävään.
                        </button>
                    </div>
                </div>
                
            </form>
        
        @else
          <li class="list-group-item">
            Tietokannan taulut:
          </li>
            <img style="width:95px;height:111px" src="http://wiki.scratch.mit.edu/w/images/Scratch_Cat.png" alt="Scratch-klubi" />
          
          <li class="list-group-item">
            Tehtävä
            {{ $tehtavan_nro }}:
            </br>
            {{ $teht->teht_kuvaus }}
            </br>
          </li>
          <li class="list-group-item">
            Yritys:
            {{ $kerta }} / 3
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
                    <input type="hidden" class="form-control" name="yr_nro" id="yr_nro" value="{{ $yr_nro  }}">
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
        @endif

    @else
        @if($yr_nro == -1 && $vaara)
          <li class="list-group-item">
            Tietokannan taulut:
          </li>
            <img style="width:95px;height:111px" src="http://wiki.scratch.mit.edu/w/images/Scratch_Cat.png" alt="Scratch-klubi" />
          <li class="list-group-item">
            Tehtävä meni väärin. Tässä esimerkkivastaus:
            </br>
            {{ $tehtavat[$nro-1]->esim_vastaus }}
          </li>
        @endif

        @if(!empty( DB::table('sessiotehtavas')->orderBy('aloitus_hetki', 'desc')->first() ))
            <?php
                $taulu = DB::table('sessiotehtavas')->orderBy('aloitus_hetki', 'desc')->first();
                DB::table('sessiotehtavas')
                    ->where([
                        'sessio_id' => $taulu->sessio_id, 
                        'op_id' => $taulu->op_id,
                        't_id' => $taulu->t_id,
                        'yritys' => $taulu->yritys     
                    ])
                    ->update([
                        'lopetus_hetki' => DB::raw('now()'),
                        'oikein' => !($vaara),
                    ]);

                DB::table('loppuneet')->insert([
                    'sessio_id' => $sessio->id, 
                    'op_id' => Auth::user()->id,
                ]);
            ?>
         @endif
            <form class="form-horizontal" role="form" method="GET" action="/kurssit">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">
                            Jatka Omat kurssit -sivulle.
                        </button>
                    </div>
                </div>
            </form>
        
    @endif
  
    </div>


  @endsection
@endif