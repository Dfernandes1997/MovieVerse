@extends('front-office.layout')

@section('content')

<!-- Modal para editar o nome da lista -->
<div class="modal fade" id="editListNameModal" tabindex="-1" aria-labelledby="editListNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
            <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
                <h5 class="modal-title" id="editListNameModalLabel">Edit WatchList Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #ec6090;"></button>
            </div>
            <div class="modal-body">
                <form id="editListNameForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="newListName" class="form-label">New Name</label>
                        <input type="hidden" id="editListId" name="listId">
                        <input type="text" class="form-control" id="editListName" name="newListName">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn" onclick="document.getElementById('editListNameForm').submit()" style="background-color: #ec6090; color: white;">Rename</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação para excluir a lista -->
<div class="modal fade" id="confirmDeleteListModal" tabindex="-1" aria-labelledby="confirmDeleteListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
            <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
                <h5 class="modal-title" id="confirmDeleteListModalLabel">Confirm Delete WatchList</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #ec6090;"></button>
            </div>
            <div class="modal-body" id="confirmDeleteListModalBody">
                Are you sure you want to delete the WatchList?
            </div>
            <div class="modal-footer">
                <form id="confirmDeleteListForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteListId" name="listId">
                    <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para criar nova lista -->
<div class="modal fade" id="createListModal" tabindex="-1" aria-labelledby="createListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
            <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
                <h5 class="modal-title" id="createListModalLabel">Create New WatchList</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #ec6090;"></button>
            </div>
            <div class="modal-body">
                <form id="createListForm" action="{{ route('favorites.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="list_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="list_name" name="list_name">
                    </div>
                    <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

            <!-- ***** Featured Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                <div class="feature-banner header-text">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="thumb">
                        <img src="{{asset('assets/front-section/images/watchlist.jpg')}}"  alt="" style="border-radius: 23px; max-height: 75px;">
                        <a><strong>{{ auth()->user()->username }}</strong></a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            @if (!$favoritos->isEmpty())
                <button type="button" class="btn btn mt-3" data-bs-toggle="modal" data-bs-target="#createListModal" style="background-color: #ec6090; color: white;">
                    New WatchList
                </button>
            @endif
            <!-- ***** Featured End ***** -->


            <!-- ***** Gaming Library Start ***** -->
            @if ($favoritos->isEmpty())
            <div class="gaming-library">
                <div class="col-lg-12">
                    <div>
                        <h4 style="text-align: center;">You Don't have a WatchList <a href="#" id="createListLink">create one now</a>!</h4>
                    </div>
                </div>
            </div>
            @else
                @foreach($favoritos as $favorito)
                    <div class="gaming-library">
                        <div class="col-lg-12">
                            <div class="heading-section">
                                <!-- Ícones para editar e excluir a lista -->
                                <h4>
                                    WatchList: <em>{{ $favorito->name }}</em>
                                    <i class="fa fa-pencil edit-list" data-bs-toggle="modal" data-bs-target="#editListNameModal" data-list-id="{{ $favorito->id }}" data-list-name="{{ $favorito->name }}" style="color: white; font-size: 20px;"></i>
                                    <i class="fa fa-trash delete-list" data-bs-toggle="modal" data-bs-target="#confirmDeleteListModal" data-list-id="{{ $favorito->id }}" data-list-name="{{ $favorito->name }}" style="color: white; font-size: 20px;"></i>
                                </h4>
                            </div>
                            @if ($favorito->multimedia->isEmpty())
                                <h6 class="text-center">You don´t have Media in this WatchList <a href="{{ route('movies.all')}}">Start add now</a>!</h6>
                            @else
                                @foreach($favorito->multimedia as $multimedia)
                                    <div class="item">
                                        <ul>
                                            <a href="{{ route('movies.show', $multimedia->id) }}">
                                                <li style="margin-right: 30px;"><img src="{{ $multimedia->poster ? $multimedia->poster : asset('assets/front-section/images/default.jpg') }}"  style="max-height: 100px; border-radius: 50px;"></li>
                                                <li><h4>{{ $multimedia->title }}</h4></li>
                                            </a>
                                            <li><h4>{{ $multimedia->released }}</h4></li>
                                            <li><h4>{{ $multimedia->runtime ? $multimedia->runtime : 'N/A' }}</h4></li>
                                            <li><h4><i class="fa fa-star" style="color: yellow;"></i> {{ $multimedia->imdb_rating ? $multimedia->imdb_rating : 'N/A' }}</h4></li>
                                            @if ($multimedia->pivot->id)
                                                <form method="POST" action="{{ route('favorites.remove', $multimedia->pivot->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link"><i class="fa fa-bookmark fa-3x" style="color: white;"></i></button>
                                                </form>
                                            @endif                                                                               
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- ***** Gaming Library End ***** -->

        </div>
      </div>
    </div>
  </div>

<script>
    // Captura o evento de clique no ícone (editar)
    document.querySelectorAll('.edit-list').forEach(function (editIcon) {
        editIcon.addEventListener('click', function () {
            var listId = this.getAttribute('data-list-id');
            var listName = this.getAttribute('data-list-name');
            // Passar os dados da lista para o modal de edição
            document.getElementById('editListId').value = listId;
            document.getElementById('editListName').value = listName;

            // Define o action do formulário de edição dinamicamente
            document.getElementById('editListNameForm').action = "{{ route('favorites.update', '') }}" + "/" + listId;
        });
    });

    // Captura o evento de clique no ícone (excluir)
    document.querySelectorAll('.delete-list').forEach(function (deleteIcon) {
        deleteIcon.addEventListener('click', function () {
            var listId = this.getAttribute('data-list-id');
            var listName = this.getAttribute('data-list-name');

            // Passar os dados da lista para o modal de exclusão
            document.getElementById('deleteListId').value = listId;
            document.getElementById('confirmDeleteListModalBody').innerHTML = 'Are you sure you want to delete "' + listName + '" ?';

            var formAction = "{{ route('favorites.destroy', '') }}" + "/" + listId;
            console.log('Form Action: ', formAction);
            // Define o action do formulário de exclusão dinamicamente
            document.getElementById('confirmDeleteListForm').action = "{{ route('favorites.destroy', '') }}" + "/" + listId;
        });
    });

    document.getElementById('createListLink').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que o link execute a ação padrão de navegação

        var modal = new bootstrap.Modal(document.getElementById('createListModal')); // Instancia o modal
        modal.show(); // Exibe o modal
    });
</script>

@endsection