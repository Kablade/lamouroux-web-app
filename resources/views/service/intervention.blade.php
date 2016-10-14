{{--
|--------------------------------------------------------------------------
| Page : Temp d'intervention
|--------------------------------------------------------------------------
|
| C'est la page appellée pour enregistrer des temps d'intervention.
|
--}}

@extends('layouts.layout')

@section('title', 'Saisie temps')
  @include('layouts.navbar')

  @section('content')
    <div class="panel panel-default animated fadeIn">
      <div class="panel-heading clearfix">
        <span class="panel-title pull-left">
          <i class="fa fa-calendar-o"></i> Temps d'intervention pour {{$header->order_no}}
        </span>
        <span class="pull-right">
          <button type="button" class="btn btn-default" id='cancel'><i class="fa fa-arrow-left"></i> Retour à la commande</button>
        </span>
      </div>
      <div class="panel-body" id="root">
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
              <i class="fa fa-check"></i>  {{ $message }}</br>
              @endforeach
            </div>
          @endif
        @endif

        @foreach($interventions as $intervention)
          <div id="intervention-{{ $intervention->id }}">
            <form method='POST' action="{{ route('header::deleteIntervention', [ 'id' => $header->order_no, 'intervId' => $intervention->id]) }}">
              <div class="row">
                <div class="col-md-5">
                  <strong><i class="fa fa-calendar"></i> Date et heure de début</strong>
                </div>
                <div class="col-md-5">
                  <strong><i class="fa fa-calendar"></i> Date et heure de fin</strong>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-5">
                  <div class='input-group date'>
                    <input type='text' class="form-control date" placeholder='Date et heure de début...' name='start_date' value='{{$intervention->start_date}}'>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-5">
                  <div class='input-group date'>
                    <input type='text' class="form-control date" placeholder='Date et heure de fin...' name='end_date' value='{{$intervention->end_date}}'>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10">
                  <strong><i class="fa fa-pencil-square-o"></i> Description de l'intervention</strong>
                </div>
                <div class="col-md-2">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-10">
                  <input type='text' class="form-control" placeholder="Description de l'intervention..." name='description' value='{{$intervention->description}}'>
                </div>
                <div >
                  <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-danger btn-block">
                      <i class="fa fa-trash-o"></i> Supprimer
                    </button>
                  </div>
                </div>
              </div>
              <hr>
              {{ csrf_field() }}
            </form>
          </div>
        @endforeach

        <div id="content" class="animated fadeInDown">
          <form id='intervention-form' method='POST' action="{{ route('header::addIntervention', $header->order_no) }}">
            <div class="row">
              <div class="col-md-5">
                <strong><i class="fa fa-calendar"></i> Date et heure de début</strong>
              </div>
              <div class="col-md-5">
                <strong><i class="fa fa-calendar"></i> Date et heure de fin</strong>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-5">
                <div class='input-group date' id='datetimepicker1'>
                  <input type='text' class="form-control date" placeholder='Date et heure de début...' name='start_date'>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group col-md-5">
                <div class='input-group date' id='datetimepicker2'>
                  <input type='text' class="form-control date" placeholder='Date et heure de fin...' name='end_date'>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <strong><i class="fa fa-pencil-square-o"></i> Description de l'intervention</strong>
              </div>
              <div class="col-md-2">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-10">
                <input type='text' class="form-control" placeholder="Description de l'intervention..." name='description'>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Valider</button>
              </div>
            </div>
            <hr>
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    @stop

    @section('customJs')
      <script type="text/javascript">
      $(function () {
        $('#datetimepicker1').datetimepicker({
          locale: 'fr',
        });
      });

      $(function () {
        $('#datetimepicker2').datetimepicker({
          locale: 'fr',
        });
      });

      $('#cancel').on('click', function() {
        history.back();
      });
      </script>
    @endsection
