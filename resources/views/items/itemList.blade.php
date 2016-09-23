{{--
|--------------------------------------------------------------------------
| Page : Liste des articles
|--------------------------------------------------------------------------
|
| Cette page affiche la liste de tous les articles. L'utilisateur
| voit le stock complet. Une icône animée lui indique si l'article
| se trouve dans son camion ou non.
|
--}}

@extends('layouts.layout')
@section('title', 'Commandes de services')
  @include('layouts.navbar')
  @section('content')
    <div class="table-responsive">
      <table id="contact-list" class="table table-hover table-bordered table-striped animated fadeIn">
        <thead>
          <tr>
            <th>Disponibilité</th>
            <th>N° article</th>
            <th>Description</th>
            <th>Qté camion</th>
            <th>Qté stock</th>
            <th>Unité de base</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $item)
            <tr>
              @if($QuantityItemPerLocation[$item->id] == 0)
                <td class="text-center">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-truck fa-stack-1x"></i>
                    <i class="fa fa-times fa-stack-2x text-danger faa-flash animated faa-fast"></i>
                  </span>
                  <span hidden>{{ false }}</span>
                </td>
              @else
                <td class="text-center">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-truck fa-stack-1x"></i>
                    <i class="fa fa-check fa-stack-2x text-sucess faa-flash animated faa-fast"></i>
                  </span>
                  <span hidden>{{ true }}</span>
                </td>
              @endif
              <td><strong>{{ $item->id }}</strong></td>
              <td>{{ $item->description }}</td>
              <td>{{ $item->phone_no }}</td>
              <td><a href="tel:{{ $item->mobile_no}}"></a></td>
              <td><a href="mailto:{{ $item->email}}"></a></td>
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
