{{--
|--------------------------------------------------------------------------
| Page : Profil utilisateur
|--------------------------------------------------------------------------
|
| C'est la page appellée pour afficher le profil de l'utilisateur
| connecté. Il peut consulter ses infos, les mettre à jour etc..
|
--}}

@extends('layouts.layout')

@section('title', 'Profil')
  @include('layouts.navbar')

  @section('content')
    <div class="panel panel-default animated fadeIn boxshadow">
      <div class="panel-heading clearfix">
        <span class="panel-title"><i class="fa fa-user "></i> Connecté en tant que <strong>{{  Auth::user()->userData->first_name }} {{  Auth::user()->userData->name }}</strong>.</span>
        <div class="panel-title pull-right">
          <button type="button" class="btn btn-default" id="cancel"><i class="fa fa-times"></i> Annuler</button>
          <button type="button" class="btn btn-success" onclick="$('#profile-form').submit();"><i class="fa fa-check"></i> Enregistrer</button>
        </div>
      </div>
      <div class="panel-body">
        @if (Session::get('messages'))
          @if (Session::get('error'))
            <div class="alert alert-danger" role="alert">
              @foreach (Session::get('messages')->all() as $error)
              <i class="fa fa-times"></i>  {{ $error }}</br>
              @endforeach
            </div>
          @else
            <div class="alert alert-success" role="alert">
              @foreach (Session::get('messages') as $message)
              <i class="fa fa-check"></i> {{ $message }}</br>
              @endforeach
            </div>
          @endif
        @endif
        <form id="profile-form" method="POST" action="{{ route('user::postProfile') }}">
          <div class="form-group col-md-6">
            <label class="control-label" for="username"><i class="fa fa-fw fa-user"></i> Nom d'utilisateur</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Nouveau nom d'utilisateur..." value="{{ Auth::user()->username }}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="email"><i class="fa fa-fw fa-at"></i> Adresse mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Nouvelle adresse mail..." value="{{ Auth::user()->email }}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="password"><i class="fa fa-fw fa-unlock-alt"></i> Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Nouveau mot de passe...">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="confirm_password"><i class="fa fa-fw fa-check"></i> Confirmation</label>
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirmer nouveau mot de passe...">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="location_code"><i class="fa fa-fw fa-map-marker"></i> Code magasin</label>
            <input type="text" class="form-control" id="location_code" name="location_code" placeholder="Nouveau code camion..." value="{{ Auth::user()->userdata->location_code }}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="email_sav"><i class="fa fa-fw fa-at"></i> Adresse mail S.A.V</label>
            <input type="email" class="form-control" id="email_sav" name="email_sav" placeholder="Nouvelle adresse mail SAV...">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="truck_brand"><i class="fa fa-fw fa-truck"></i> Marque</label>
            <input type="text" class="form-control" id="truck_brand" name="truck_brand" placeholder="Nouvelle marque..." value="{{ Auth::user()->userdata->truck_brand }}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="truck_model"><i class="fa fa-fw fa-truck"></i> Modèle</label>
            <input type="text" class="form-control" id="truck_model" name="truck_model" placeholder="Nouveau modèle..." value="{{ Auth::user()->userdata->truck_model }}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label" for="truck_serial_no"><i class="fa fa-fw fa-truck"></i> N° de série</label>
            <input type="text" class="form-control" id="truck_serial_no" name="truck_serial_no" placeholder="Nouveau numéro de série..." value="{{ Auth::user()->userdata->truck_serial_no }}">
          </div>
          <div class='form-group col-md-6'>
            <label class="control-label" for="checked_at"><i class="fa fa-fw fa-calendar"></i> Date de contrôle</label>
            <div class='input-group date'id="checked_at">
              <input type='text' name="checked_at" class="form-control" value="{{ Auth::user()->userdata->checked_at }}">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    @stop

    @section('customJs')
      <script type="text/javascript">
      $(function () {
        $('#checked_at').datetimepicker({
          locale: 'fr',
        });
      });

      $('#cancel').on('click', function() {
        history.back();
      });
      </script>
    @endsection
