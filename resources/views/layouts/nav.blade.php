<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">Etusivu</a>


  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
        </div>
      </li>
    </ul>

    <a class="nav-link" href='/tehtavalistas'>Kaikki tehtävälistat</a>

          @if(!Auth::check())
          <il class="ml-auto">
            <a class="nav-link" href='/login'>Log in</a>
          </il>
          @endif

          @if(Auth::check())
            <a class="nav-link" href='/tehtavalistas/create'>Luo tehtävälista</a>    
            <a class="navbar-brand" href="#" >{{ Auth::user()->name }}</a>
            <il class="ml-auto">
              <a class="nav-link" href='/logout'>Log out</a>             
            </il>
          @endif

  </div>
</nav>
