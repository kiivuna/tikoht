@if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))
  <div class="blog-post">
    <h2 class="blog-post-title">
      <a href="/tehtavalistas/{{ $tehtavalista->id }}">
        {{ $tehtavalista->tehtlista_kuvaus }} 
      </a>
    </h2>
    <p class="blog-post-meta">
    	Tekijä: 
      <b>{{ App\User::find($tehtavalista->tehtlista_luoja_id)->name }} </b>
      </br>
      päiväys: 
      <i>{{ $tehtavalista->created_at->toFormattedDateString() }} </i>
      </br>
    </p>


  </div><!-- /.blog-post -->
@endif