@if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))
  <div class="blog-post">
    <h2 class="blog-post-title">
      <a href="/sessios/{{ $sessio->id }}">
        Kurssille <i>{{ DB::table('kurssis')->having('id', $sessio->kurssi_id)->groupBy('id')->first()->nimi }} </i> tehtävälista <i> {{ DB::table('tehtavalistas')->having('id', $sessio->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus }} </i>
      </a>
    </h2>
    <p class="blog-post-meta">
      Kurssi: 
      <i>{{ DB::table('kurssis')->having('id', $sessio->kurssi_id)->groupBy('id')->first()->nimi }}</i>
      </br>
      Tehtävälista: 
      <i>{{ DB::table('tehtavalistas')->having('id', $sessio->tehtlista_id)->groupBy('id')->first()->tehtlista_kuvaus }}</i>
      </br>
      Tekijä: 
      <b>{{ App\User::find($sessio->session_luoja_id)->name }} </b>
      </br>
      päiväys: 
      <b>{{ $sessio->created_at->toFormattedDateString() }} </b>
    </p>


  </div><!-- /.blog-post -->
@endif