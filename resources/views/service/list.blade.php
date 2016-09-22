{{--
|--------------------------------------------------------------------------
| Page : Liste des commandes de service
|--------------------------------------------------------------------------
|
| Page d'affichage de la liste des commandes de service.
| Fait office de page d'accueil du site.
| Contient un tableau geré par DataTables. (JS+CSS)
|
--}}

@extends('layouts.layout')
@section('title', 'Commandes de services')
  @include('layouts.navbar')
  @section('content')
    @if (Session::get('messages'))
      @if (Session::get('error'))
        <div class="alert alert-danger" role="alert">
          @foreach (Session::get('messages')->all() as $error)
            {{ $error }}</br>
          @endforeach
        </div>
      @else
        <div class="alert alert-warning" role="alert">
          @foreach (Session::get('messages') as $message)
            {{ $message }}</br>
          @endforeach
        </div>
      @endif
    @endif
    <div class="table-responsive">
      <table id="order-list" class="table table-hover table-bordered table-striped animated fadeIn">
        <thead>
          <tr>
            <th>Statut</th>
            <th>N° commande</th>
            <th>Description commande</th>
            <th>Nom client</th>
            <th>Nom contact</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($headers as $header)
            <tr>
              @if($header->status==0)
                <td class="success text-center"><i class="fa fa-check fa-lg"></i> <span hidden>{{ $header->status }}<span></td>
                @elseif($header->status==1)
                  <td class="warning text-center"><i class="fa fa-clock-o fa-lg"></i> <span hidden>{{ $header->status }}<span></td>
                  @else
                    <td class="info text-center"><i class="fa fa-arrow-right fa-lg"> <span hidden>{{ $header->status }}<span></td>
                    @endif
                    <td><strong>{{ $header->order_no }}<strong></td>
                      <td>{{ $header->description }}</td>
                      <td>{{ $header->customer_name }}</td>
                      <td>{{$header->contact_name}}</td>
                      <td><button class="btn btn-primary btn-block" onclick="window.location = '{{ route('header::get', $header->order_no) }}';">
                        <i class="fa fa-eye"></i> Voir la commande
                      </button></td>
                    </tr>
                  </a>
                @endforeach
              </tbody>
            </table>
          </div>
        @stop

        @section('customJs')
          <script text="text/javascript">
          $(document).ready(function() {
            $('#order-list').DataTable({
              "pageLength": 30,
              "language": {
                  "sProcessing":     "Traitement en cours...",
                  "sSearch":         "Rechercher&nbsp;:",
                  "sLengthMenu":     "Afficher _MENU_ commandes",
                  "sInfo":           "Affichage des commandes _START_ &agrave; _END_ sur _TOTAL_",
                  "sInfoEmpty":      "Aucune commande disponible",
                  "sInfoFiltered":   "(filtr&eacute; de _MAX_ commandes au total)",
                  "sInfoPostFix":    "",
                  "sLoadingRecords": "Chargement en cours...",
                  "sZeroRecords":    "Aucune commande ne correspond &agrave; vos critères",
                  "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
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
