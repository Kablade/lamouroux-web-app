{{--
|--------------------------------------------------------------------------
| Layout NavBar
|--------------------------------------------------------------------------
|
| Navbar appellée en début de chaque page du site (sauf login)
|
--}}

@section('nav')
  <nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="{{ route('header::all') }}"><i class="fa fa-home"></i> Liste des commandes</a></li>
          <li><a href="{{ route('user::getProfile') }}"><i class="fa fa-user"></i> Profil</a></li>
          <li><a href="{{ route('user::signature') }}"><i class="fa fa-pencil"></i> Signature</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('user::logout') }}"><i class="fa fa-power-off"></i> Déconnexion</a></li>
        </ul>
      </div>
    </div>
  </nav>
@stop
