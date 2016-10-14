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
<div class="text-center">
  <ul id="pagination" class="pagination"></ul>
</div>
<table id="contact-list" class="table table-hover table-bordered table-striped animated fadeIn">
  <thead>
    <tr>
      <th>Disponibilité</th>
      <th>N° article</th>
      <th>Description</th>
      <th>Qté camion</th>
      <th>Unité de base</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($items as $item)
      <tr>
        @if(isset($QuantityItemPerLocation[$item->id]))
          @if($QuantityItemPerLocation[$item->id] > 0)
            <td class="text-center">
              <span class="fa-stack fa-lg">
                <i class="fa fa-truck fa-stack-1x"></i>
                <i class="fa fa-check fa-stack-2x text-success faa-flash animated"></i>
              </span>
              <span hidden>{{ true }}</span>
            </td>
          @else
            <td class="text-center">
              <span class="fa-stack fa-lg">
                <i class="fa fa-truck fa-stack-1x"></i>
                <i class="fa fa-times fa-stack-2x text-danger faa-flash animated"></i>
              </span>
              <span hidden>{{ false }}</span>
            </td>
          @endif
        @else
          <td class="text-center">
            <span class="fa-stack fa-lg">
              <i class="fa fa-truck fa-stack-1x"></i>
              <i class="fa fa-times fa-stack-2x text-danger faa-flash animated"></i>
            </span>
            <span hidden>{{ false }}</span>
          </td>
        @endif
        <td><strong>{{ $item->id }}</strong></td>
        <td>{{ $item->description }}</td>
        @if(isset($QuantityItemPerLocation[$item->id]))
          @if($QuantityItemPerLocation[$item->id] > 0)
            <td>{{ round($QuantityItemPerLocation[$item->id],2) }}</td>
          @else
            <td><i class="fa fa-ban text-danger"></i></td>
          @endif
        @else
          <td><i class="fa fa-ban text-danger"></i></td>
        @endif
        <td>{{ $item->unit}}</td>
      </tr>
  @endforeach
</tbody>
</table>
<div class="text-center">
  <ul id="pagination" class="pagination"></ul>
</div>
@stop

@section('customJs')
<script type="text/javascript">

$('#pagination').twbsPagination({
        totalPages: {{ $items->lastPage() }},
        visiblePages: 7,
        first: "Première",
        last: "Dernière",
        prev: "Précédente",
        next: "Suivante",
        startPage: {{ $items->currentPage() }},
        initiateStartPageClick: false,
        onPageClick: function (click, page) {
          window.location.href="{{ route('getItems') }}"+"?page="+page;
          $('#page-content').text('Page ' + page);
          //console.log("slt");
        }
    });

</script>
@endsection
