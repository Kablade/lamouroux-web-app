{{--
|--------------------------------------------------------------------------
| Page : Carte client / contact
|--------------------------------------------------------------------------
|
| C'est la page appellée pour afficher le détail d'un client / contacts,
| elle présente un entête avec les détails du contact selectionné, et
| des lignes avec tous les contacts liés.
|
--}}

@extends('layouts.layout')

@section('title')
  Contact {{$customer->id}}
@endsection
@include('layouts.navbar')

@section('content')
  <div class="panel panel-default animated fadeIn">
    <div class="panel-heading clearfix">
      <span class="panel-title">
        @if ($customer->type == 0)
          <i class="fa fa-building-o"></i> Contact societé n°
        @else
          <i class="fa fa-user"></i> Contact personne n°
        @endif
        {{$customer->id}}
      </span>
      <div class="panel-title pull-right">
        <button type="button" class="btn btn-default" id='cancel'><i class="fa fa-arrow-left"></i> Retour</button>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><i class="fa fa-fw fa-info"></i><strong> N° contact : </strong>{{$customer->id}}</div>
        <div class="col-md-4"><i class="fa fa-fw fa-font"></i><strong> Nom contact : </strong>{{$customer->name}}</div>
        <div class="col-md-4"><a href="tel:{{$customer->phone}}"><i class="fa fa-fw fa-phone"></i><strong> Téléphone : </strong>{{$customer->phone}}</a></div>
      </div>
      <div class="row">
        <div class="col-md-4"><i class="fa fa-fw fa-map-marker"></i><strong> Adresse : </strong>{{$customer->address}}</div>
        <div class="col-md-4"><i class="fa fa-fw fa-map-marker"></i><strong> Adresse (suite) : </strong>{{$customer->address2}}</div>
      </div>
      <div class="row">
        <div class="col-md-4"><i class="fa fa-fw fa-map-signs"></i><strong> Code postal : </strong>{{$customer->post_code}}</div>
        <div class="col-md-4"><i class="fa fa-fw fa-map-signs"></i><strong> Ville : </strong>{{$customer->city}}</div>
      </div>
      <div class="row">
        <div class="col-md-4"><a href="tel:{{$customer->mobile}}"><i class="fa fa-fw fa-mobile"></i><strong> Mobile : </strong>{{$customer->mobile}}</a></div>
        <div class="col-md-4"><a href="mailto:{{$customer->mail}}"><i class="fa fa-fw fa-at"></i><strong> Mail : </strong>{{$customer->mail}}</a></div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <table class="table table-hover table-bordered table-striped">
      <thead>
        <th>Type</th>
        <th>N° contact</th>
        <th>Nom contact</th>
        <th>N° téléphone</th>
        <th>N° mobile</th>
        <th>E-mail</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($contacts as $contact)
          <tr>
            @if($contact->type==0)
              <td class="primary text-center"><i class="fa fa-building fa-lg"></i> <span hidden>{{ $contact->type }}<span></td>
            @elseif($contact->type==1)
              <td class="information text-center"><i class="fa fa-user fa-lg"></i> <span hidden>{{ $contact->type }}<span></td>
            @endif
              <td><strong>{{ $contact->id }}<strong></td>
              <td>{{ $contact->name }}</td>
              <td><a href="tel:{{ $contact->phone_no }}">{{ $contact->phone }}</a></td>
              <td><a href="tel:{{ $contact->mobile_no}}">{{ $contact->mobile}}</a></td>
              <td><a href="mailto:{{ $contact->email}}">{{ $contact->email}}</a></td>
              <td>
                <button class="btn btn-primary btn-block" onclick="window.location = '{{ route('customer::getCustomer', $contact->id) }}';">
                  <i class="fa fa-eye"></i> Fiche détaillée
                </button>
              </td>
            </tr>
          </a>
        @endforeach
      </tbody>
    </table>
  </div>
  @if($contacts->count()===0)
    <p class="help-block">Ce contact n'a aucun contacts associés.</p>
  @endif
@stop

@section('customJs')
  <script type="text/javascript">
  $('#cancel').on('click', function() {
    history.back();
  });
  </script>
@endsection
