{{--
|--------------------------------------------------------------------------
| Page : Commande de service
|--------------------------------------------------------------------------
|
| C'est la page appellée pour afficher le détail d'UNE commande.
| On peut depuis cette page consulter plusieurs rubriques,
| valider la commande etc..
|
--}}

@extends('layouts.layout')

@section('title')
  Commande {{$header->order_no}}
@endsection
@include('layouts.navbar')

@section('content')
  <div class="panel panel-default animated fadeIn boxshadow">
    <div class="panel-heading clearfix">
      <span class="panel-title"><i class="fa fa-file-text-o"></i> Commande {{$header->order_no}}</span>
      <div class="panel-title pull-right">
        <button type="button" class="btn btn-default" id='cancel'><i class="fa fa-arrow-left"></i> Retour à la liste</button>
        <a type="button" href="{{ route('header::getIntervention', $header->order_no) }}" class="btn btn-default vertical-align"><i class="fa fa-calendar"></i> Temps d'intervention</a>
        <button type="button" class="btn btn-success" id="myBtn"><i class="fa fa-check"></i> Valider la commande</button>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><a href="{{ route('customer::getCustomer', $header->customer_no) }}"><i class="fa fa-fw fa-user"></i><strong> Client : </strong>{{$header->customer_name}}</a></div>
        <div class="col-md-4"><a href="tel:{{$header->phone_no}}"><i class="fa fa-fw fa-phone"></i><strong> Téléphone : </strong>{{$header->phone_no}}</a></div>
        <div class="col-md-4"><a href="tel:{{$header->mobile_no}}"><i class="fa fa-fw fa-mobile"></i><strong> Mobile : </strong>{{$header->mobile_no}}07 51 78 32 48</a></div>
      </div>
      <div class="row">
        <div class="col-md-4"><a href="{{ route('customer::getCustomer', $header->contact_no) }}"><i class="fa fa-fw fa-user"></i><strong> Contact : </strong>{{$header->contact_name}}BODIN</a></div>
        <div class="col-md-4">
          <a href="mailto:{{$header->email}}?body=">
            <i class="fa fa-fw fa-at"></i><strong> E-mail : </strong>{{$header->email}}email-du-client@gmail.com
          </a>
        </div>
        <div class="col-md-4"><i class="fa fa-fw fa-fax"></i><strong> Fax : </strong>{{$header->fax_no}}</div>
      </div>
      <div class="row">
        <div class="col-md-4"><i class="fa fa-fw fa-map-marker"></i><strong> Adresse : </strong>{{$header->address}}</div>
        <div class="col-md-4"><i class="fa fa-fw fa-comments-o"></i><strong> Commentaire : </strong>{{$header->general_comment}}Commentaire général.</div>
      </div>
      <div class="row">
        <div class="col-md-4"><i class="fa fa-fw fa-map-signs"></i><strong> Ville : </strong>{{$header->city}}</div>
        <div class="col-md-4"><i class="fa fa-fw fa-map-signs"></i><strong> CP : </strong>{{$header->post_code}}</div>
      </div>
    </div>
  </div>
  <div class="panel panel-default boxshadow">
    <table class="table table-hover table-bordered table-striped">
      <thead>
        <th>N° article de service</th>
        <th>Description</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($lines as $line)
          <tr>
            <td>{{ $line->resource_no }}</td>
            <td>{{ $line->description }}</td>
            <td class='col-md-2'>
              <a class="btn btn-primary btn-block" href="{{ route('header::lines::get', ['headerId' => $header->order_no, 'resId' => $line->resource_no]) }}">
                <i class="fa fa-eye"></i> Interventions
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @if($lines->count()===0)
    <p class="help-block">Aucune ligne trouvée pour cette commande.</p>
  @endif
@stop

@section('customJs')
  <script type="text/javascript">
  $('#cancel').on('click', function() {
    history.back();
  });
  </script>
@endsection
