{{--
|--------------------------------------------------------------------------
| Page : Signature
|--------------------------------------------------------------------------
|
| C'est la page appellée pour enregistrer un nouvelle signature.
|
--}}

@extends('layouts.layout')

@section('title', 'Signature')
  @include('layouts.navbar')

  @section('content')
    <div class="panel panel-default animated fadeIn boxshadow">
      <div class="panel-heading"  style="padding-bottom: 20px">
        <span class="panel-title"><i class="fa fa-pencil-square-o fa-lg"></i> Votre signature</span>
        <div class="panel-title pull-right">
          <button type="button" class="btn btn-default" id="cancel"><i class="fa fa-times"></i> Annuler</button>
          <button type="button" class="btn btn-success" onClick="saveSign()"><i class="fa fa-check"></i> Enregistrer</button>
        </div>
      </div>
      <div class="panel-body">
        @if(file_exists(public_path('sign/'.Auth::user()->id.'.png')))
        <div class="row">
          <div class="col-lg-12">
            <span class="help-block">Signature actuelle :</span>
            <img class="img-responsive" src="{{ asset('sign/'.Auth::user()->id.'.png') }}"></img>
          </div>
        </div>
        @endif
        <hr>
        <div class="row">
          <div class="col-lg-12">
            <span class="help-block">Nouvelle signature :</span>
            <canvas id="simple_sketch" class="sign" height="300"></canvas>
            <form id="form-sign" method="POST" action="{{ route('user::postSignature') }}">
              <input id="picture-base64" type="text" name="pictureBase64" hidden></input>
              {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    @stop

    @section('customJs')
      <script>
        $(function() {
          $('#simple_sketch').sketch();
        });

        $('#cancel').on('click', function() {
          history.back();
        });

        var saveSign = function() {
          var sketch = document.getElementById('simple_sketch').toDataURL("image/png", 1.0);
          $('#picture-base64').val(sketch);
          $('#form-sign').submit();
        }
      </script>
    @endsection
