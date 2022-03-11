@extends('layouts.app')

<link rel="stylesheet" href="/css/dashboard.css">


@section('content')
    
    <div class="container recap">
        <div>
            <h4> Total caisse </h4>
            <hr style="border : 1px solid #ffb100;" />
            <h3> {{$totals['ajout'] - $totals['retrait']}} €  </h3>
        </div>
        <hr style="border : 1px solid #ffb100;" />
        <div>
            <span> Retrait : {{$totals['retrait']}} € </span>
        </div>
        <div>
            <span> Ajout : {{$totals['ajout']}} € </span>
        </div>
    </div>
    <div class="container">
        <h4> Opération du : </h4>
        <input type="date" id="dateFilter" class="form-control" />
        <hr style="border : 1px solid #ffb100;" />
        <a href="/operation" class="btn btn-success mb-2">Nouveau</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Type d'opération</th>
                <th scope="col">Montant</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach ($operations as $operation)
              <tr>
                <th scope="row">{{ $operation->id }}</th>
                <td>{{ $operation->date }}</td>
                <td>{{ $operation->operationType->name }}</td>
                <td>{{ $operation->total }} €</td>
                <td>{{ $operation->note }}</td>
                <td>
                    <a href="/operation/{{ $operation->id}}"> <i class="bi bi-pencil"></i> </a> 
                    <i class="bi bi-trash btn_delete" data-id="{{ $operation->id }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"></i>
                </td>
              </tr>
            @endforeach
              
            </tbody>
          </table>
          @if (count($operations) == 0) 
              <span class="mb-4"> Aucune données enregistrées </span>
          @endif
    </div>

     <!-- Modal for deleteConfirm !-->
     <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteConfirmModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Voulez-vous vraiment supprimer?
          </div>
          <div class="modal-footer">
            <button id="cancelDelete" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button id="confirmDelete" type="button" class="btn btn-primary">Confirmer</button>
          </div>
        </div>
      </div>
    </div>

    <form id="deleteForm" method="POST" action="/operation/delete">
      @csrf
      <input type="hidden" name="delete_id" />
    </form>

   
@endsection

@section('script')
  <script type="text/javascript">

          var url = new URL(window.location.href);

          console.log(url.searchParams.get('date'))

          $("#dateFilter").val(url.searchParams.get('date'))


          $("#dateFilter").on('change', function() {
            var url = new URL(window.location.href);

            url.searchParams.set('date', $(this).val());

            window.location.replace(url);
          })

          $(".btn_delete").on('click', function() {
              $("input[name=delete_id]").attr('value', $(this).attr('data-id'));
          })

          $("#confirmDelete").on('click', function() {
              $("#deleteForm").submit();
          })
  </script>
@endsection