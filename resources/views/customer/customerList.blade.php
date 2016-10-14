{{--
|--------------------------------------------------------------------------
| Page : Liste des clients
|--------------------------------------------------------------------------
|
| Cette page affiche la liste de tous les clients. (Cette liste provient
| en fait de la table Contact de NAV) Lors de l'accès à la base
| un premier tri est effectué : tous les clients (et contacts)
| sans nom sont ignorés.
|
--}}

@extends('layouts.layout')
@section('title', 'Contacts')
@include('layouts.navbar')
@section('content')
  <div class="table-responsive">
    <table id="contact-list" class="table table-hover table-bordered table-striped animated fadeIn">
      <thead>
        <tr>
          <th>Type</th>
          <th>N° contact</th>
          <th>Nom contact</th>
          <th>N° téléphone</th>
          <th>N° mobile</th>
          <th>E-mail</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($customers as $customer)
          <tr>
            @if($customer->type==0)
              <td class="success text-center"><i class="fa fa-building fa-lg"></i> <span hidden>{{ $customer->type }}<span></td>
            @elseif($customer->type==1)
              <td class="info text-center"><i class="fa fa-user fa-lg"></i> <span hidden>{{ $customer->type }}<span></td>
            @endif
            <td><strong>{{ $customer->id }}<strong></td>
            <td>{{ $customer->name }}</td>
            <td><a href="tel:{{$customer->phone}}">{{$customer->phone}}</a></td>
            <td><a href="tel:{{ $customer->mobile}}">{{ $customer->mobile}}</a></td>
            <td><a href="mailto:{{ $customer->email}}">{{ $customer->email}}</a></td>
            <td>
              <button class="btn btn-primary btn-block" onclick="window.location = '{{ route('customer::getCustomer', $customer->id) }}';">
                <i class="fa fa-eye"></i> Fiche détaillée
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop

@section('customJs')
  <script text="text/javascript">
  $(document).ready(function() {
    $('#contact-list').DataTable({
      "pageLength": 30,
      "language": {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher&nbsp;:",
        "sLengthMenu":     "Afficher _MENU_ contacts",
        "sInfo":           "Affichage des contacts _START_ &agrave; _END_ sur _TOTAL_",
        "sInfoEmpty":      "Aucun contact disponible",
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun contact ne correspond &agrave; vos critères",
        "sEmptyTable":     "Aucun contact disponible",
        "oPaginate": {
          "sFirst":      "Premier",
          "sPrevious":   "Pr&eacute;c&eacute;dent",
          "sNext":       "Suivant",
          "sLast":       "Dernier"
        },
        "oAria": {
          "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }
    });
  });
  </script>
@endsection
