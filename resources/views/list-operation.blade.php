@extends('layouts.app')

<link rel="stylesheet" href="/css/list.css">


@section('content')
    <div class="container">
        <h3> Liste des types d'opérations </h3>
        <button id="btnOpenModal" class="btn btn-success mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal">Nouveau</button>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Mode</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($operationTypes as $operationType)
                <tr>
                  <th scope="row">{{ $operationType->id }}</th>
                  <td>{{ $operationType->name }}</td>
                  <td> {{ $operationType->is_ajout ?  "Ajout à la caisse" : "Retrait à la caisse"}} </td>
                  <td>
                      <i class="bi bi-pencil btnEdit" 
                        data-id="{{ $operationType->id }}" 
                        data-name="{{ $operationType->name }}"
                        data-is_ajout="{{$operationType->is_ajout}}"></i>
                        <i class="bi bi-trash btnDelete" data-id="{{ $operationType->id }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"></i>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @if (count($operationTypes) == 0) 
              <span class="mb-4"> Aucune données enregistrées </span>
          @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form class="modal-content" action="" method="POST" id="form">
            @csrf
            <input type="hidden" name="id"  />
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout / Modification d'un type d'opération</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom :</label>
                    <input name="name" type="text" class="form-control" id="name" autocomplete="off" required>
                </div>
                <div class="md-3">
                    <label> Mode : </label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mode" id="ajout" value="ajout" checked required>
                            <label class="form-check-label" for="ajout">
                              Ajout à la caisse
                            </label>
                          </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mode" id="retrait" value="retrait" required>
                            <label class="form-check-label" for="retrait">
                              Retrait à la caisse
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
        </div>
    </div>

    <form id="deleteForm" method="POST" action="/list-operation/delete">
        @csrf
        <input type="hidden" name="delete_id" />
    </form>

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
@endsection 

@section('script')
    <script type="text/javascript">
        (function() {

          $(".btnEdit").on('click', function() {

              $("#btnOpenModal").trigger('click');

              $("input[name=id]").attr('value', $(this).attr('data-id'));

              $("input[name=name]").attr('value', $(this).attr('data-name'));

              $("input[name=mode][value=ajout]").removeAttr('checked');

              if($(this).attr('data-is_ajout') == '1') {
                $("input[name=mode][value=retrait]").removeAttr('checked');
                $("input[name=mode][value=ajout]").attr('checked','true');

              } else {
                $("input[name=mode][value=ajout]").removeAttr('checked');
                $("input[name=mode][value=retrait]").attr('checked','true');
              }

              $("#form").attr('action', '/list-operation/update');
 
          })

          $("#exampleModal").on("hidden.bs.modal", function () {
              // put your default event here
              $("input[name=id]").attr('value', '');
              $("input[name=name]").attr('value', '');
              $("input[name=mode][value=retrait]").removeAttr('checked');
              $("input[name=mode][value=ajout]").attr('checked','checked');

              $("#form").attr('action', '');
          });

          $(".btnDelete").on('click', function() {
              $("input[name=delete_id]").attr('value', $(this).attr('data-id'));
          })

          $("#confirmDelete").on('click', function() {
              $("#deleteForm").submit();
          })



        })()
    </script>
@endsection
