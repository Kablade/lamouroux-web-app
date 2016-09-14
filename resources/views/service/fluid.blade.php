{{--
|--------------------------------------------------------------------------
| Page : Lignes services
|--------------------------------------------------------------------------
|
| C'est la page appellée pour afficher les lignes de service liées à
| une commande de service.
|
--}}

@extends('layouts.layout')

@section('title', 'Lignes service')

  @include('layouts.navbar')

  @section('content')
    <div class="panel panel-default animated fadeIn boxshadow">
      <div class="panel-heading clearfix">
        <span class="panel-title"><i class="fa fa-tint"></i> Fluides</span>
        <div class="pull-right">
          <button type="button" class="btn btn-default" id='cancel'><i class="fa fa-arrow-left"></i> Retour aux lignes</button>
          <button type="button" class="btn btn-success" onclick="$('#fluid-form').submit();"><i class="fa fa-check"></i> Valider fluides</button>
        </div>
      </div>
      <div class="panel-body">
        @if (Session::get('messages'))
          @if (Session::get('error'))
            <div class="alert alert-danger" role="alert">
              @foreach (Session::get('messages')->all() as $error)
                {{ $error }}</br>
              @endforeach
            </div>
          @else
            <div class="alert alert-success" role="alert">
              @foreach (Session::get('messages') as $message)
                {{ $message }}</br>
              @endforeach
            </div>
          @endif
        @endif
        <form id="fluid-form" method="POST" action="{{ route('header::lines::fluid', [$headerId, $resId]) }}">
          <div class="form-group col-md-6">
            <label class="control-label">N° bouteille</label>
            <input type="text" name="bottle-no" class="form-control" placeholder="Numéro de bouteille..." value="{{$lines->bottle_no}}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">Fluide récupéré & réintroduit</label>
            <input type="text" name="fluid-reintroduced" step="0.01" class="form-control" placeholder="Fluide récupéré & réintroduit..." value="{{$lines->fluid_reintroduced}}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">N° bouteille transfert</label>
            <input type="text" name="shift-bottle-no" class="form-control" placeholder="Numéro de bouteille transfert..." value="{{$lines->shift_bottle_no}}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">Fluide neuf changé</label>
            <input type="text" name="fluid-new" class="form-control" placeholder="Fluide neuf changé..." value="{{$lines->fluid_new}}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">Fluide récupéré</label>
            <input type="text" name="fluid-recovered" class="form-control" placeholder="Fluide récupéré..." value="{{$lines->fluid_recovered}}">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">Fluide à retraiter</label>
            <input type="text" name="fluid-to-retreat" class="form-control" placeholder="Fluide à retraiter..." value="{{$lines->fluid_retired}}">
          </div>
          <div class="form-group col-md-6">
            <div class="checkbox checkbox-primary">
              <input type="checkbox" id="checkFluid" class="styled">
              <label for="checkFluid">
                Fiche intervention fluide
              </label>
            </div>
          </div>
          <div class="form-group col-md-6">
            <div class="checkbox checkbox-primary">
              <input type="checkbox" id="checkCertificate" class="styled"></input>
              <label for="checkCertificate">
                Certificat d'étanchéité
              </label>
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  @stop

  @section('customJs')
    <script type="text/javascript">
    $('#cancel').on('click', function() {
      history.back();
    });
    </script>
  @endsection
