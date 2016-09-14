{{--
|--------------------------------------------------------------------------
| Page : Login
|--------------------------------------------------------------------------
|
| Page appellée par n'importe quelle page si aucun utilisateur n'est
| connecté. Egalement appellée par l'adresse users/login.
|
--}}

@extends('layouts.layout')

@section('title', 'Connexion')

  @section('content')
    <div class="row login-form animated fadeIn">
      <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center">Merci de vous connecter</div>
          <div class="panel-body">
            @if (session('error'))
              <div class="alert alert-danger" role="alert">
                {{ session('message') }}
              </div>
            @endif
            <form class="form-horizontal" action="{{ route('user::doLogin') }}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-lg-12">
                  <input name="username" type="text" required="required" class="form-control" id="input-user" placeholder="Votre identifiant...">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12">
                  <input name="password" type="password" required="required" class="form-control" id="input-password" placeholder="Votre mot de passe...">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12">
                  <div class="checkbox">
                      <input class="styled" type="checkbox" id="checkbox-rememberme" name="rememberMe">
                      <label for="checkbox-rememberme">
                        Se souvenir de moi
                      </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success">Connexion</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endsection
