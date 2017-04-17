<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">Etusivu</a>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    @if(!Auth::check())
    <il class="ml-auto">
      <a class="nav-link" href='/login'>Log in</a>
    </il>
    @endif

    @if(Auth::check() && ( !empty( DB::table('opettajat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))
      <a class="nav-link" href='/tehtavalistas'>Kaikki tehtävälistat</a>
      <a class="nav-link" href='/tehtavalistas/omat'>Omat tehtävälistat</a>
      <a class="nav-link" href='/tehtavalistas/create'>Luo tehtävälista</a> 
      <a class="nav-link" href='/sessios/create'>Luo sessio</a>
      <a class="nav-link" href='/sessios/omat'>Omat luodut sessiot</a> 
    @endif

    @if(Auth::check() && ( Auth::user()->isAdmin() ))
      <a class="nav-link" href='/sessios'>Kaikkien opettajien sessiot</a> 
    @endif

    @if(Auth::check() && ( !empty( DB::table('opiskelijat')->having('id', Auth::user()->id)->groupBy('id')->first() ) || Auth::user()->isAdmin() ))
      <a class="nav-link" href='/kurssit'>Kurssit</a>
    @endif


    @if(Auth::check())
      <il class="ml-auto">
        <a class="navbar-brand" href="#" >{{ Auth::user()->name }}</a>
      </il>
      <il> 
        <a class="nav-link" href='/logout'>Log out</a>             
      </il>
    @endif
  </div>
</nav>
