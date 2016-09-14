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
        <i class="fa fa-sitemap"></i> Lignes pour l'article {{ $ressourceId }}
        <div class="pull-right">
          <button type="button" class="btn btn-default" id='cancel'><i class="fa fa-arrow-left"></i> Retour à la commande</button>
          <a type="button" class="btn btn-default" href="{{ route('header::lines::fluid', ['headerId'=>$header->order_no, 'resId'=>$ressourceId]) }}">
            <i class="fa fa-tint"></i> Gérer fluides
          </a>
          <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Valider & générer rapport</button>
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
        <table class="table table-responsive table-hover table-bordered table-striped">
          <thead>
            <th>Type</th>
            <th>N° ressource</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Unité</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($serviceLines as $serviceLine)
              <tr>
                <td>{{ $serviceLine->type_str }}</td>
                <td>{{ $serviceLine->id }}</td>
                <td>{{ $serviceLine->description }}</td>
                <td>{{ $serviceLine->quantity }}</td>
                <td>{{ $serviceLine->unit }}</td>
                <td>
                  <button class="btn btn-danger btn-block"><i class="fa fa-times"></i> Supprimer</button>
                </td>
              </tr>
            @endforeach
            <tr>
              <td>
                <select name="type" id="select-type" class="form-control">
                  <option value=1>Article</option>
                  <option value=2>Main d'oeuvre</option>
                </select>
              </td>
              <td colspan="2"><select name="id" id="input-id" class="form-control"></select></td>
              <td><input class="form-control" type="number" name="quantity" step="0.01"></input></td>
              <td class="text-center"><i class="fa fa-times"></i></td>
              <td>
                <button class="btn btn-success btn-block"><i class="fa fa-plus"></i> Ajouter</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  @stop

  @section('customJs')
    <script type="text/javascript">

      var getSelect2Constructor = function () {
        return {
          ajax: {
            delay: 250,
            url: getAjaxUrl(),
            dataType: 'json',
            data: function (params) {
              return {
                description: params.term,
                id: params.term
              };
            },
            processResults: function(data, params) {
              var dataSelect2 = [];

              data.data.forEach((element, index, array) => {
                dataSelect2.push({
                  id: element.id,
                  text:  element.id + ' - ' + element.description,
                });
              });

              return {
                results: dataSelect2,
              }
            },
          },
          cache: true,
        };
      };

      $(document).ready(function() {
        //-------------------
        //Id field
        //-------------------
        $('#input-id').select2(getSelect2Constructor());
      });

      var getAjaxUrl = function () {
        var type = $("#select-type").val();
        if(type==1)
          return "{{ route('api::getItem') }}";
      };

      $('#cancel').on('click', function() {
        history.back();
      });
    </script>
  @endsection
