@extends('front-office.layout')

@section('content')

<!-- Modal Add Favorites -->
<div class="modal fade" id="addToFavoritesModal" tabindex="-1" aria-labelledby="addToFavoritesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
      <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
        <h5 class="modal-title" id="addToFavoritesModalLabel">Add Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" style="background-color: #ec6090;"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('add.to.favorites') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="favoriteList" class="form-label">Add to WatchList:</label>
            <select class="form-select" id="favoriteList" name="favoriteList">
              @auth
                @if ($favoriteLists->isEmpty())
                    <option value="">You don't have none</option>
                @else
                    <option value="">Choose one</option>
                    @foreach ($favoriteLists as $favoriteList)
                        <option value="{{ $favoriteList->id }}">{{ $favoriteList->name }}</option>
                    @endforeach
                @endif
              @endauth
          </select>
          </div>
          <div class="mb-3">
            <label for="newListName" class="form-label">Create a new one:</label>
            <input type="text" class="form-control" id="newListName" name="newListName">
          </div>
          <input type="hidden" id="multimediaIdInput" name="multimedia_id" value="">
          <div class="modal-footer" style="background-color: rgba(31,33,34,0.95);">
            <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Manage Favorites -->
<div class="modal fade" id="manageFavoritesModal" tabindex="-1" aria-labelledby="manageFavoritesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
      <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
        <h5 class="modal-title" id="manageFavoritesModalLabel">Manage Watchlist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" style="background-color: #ec6090;"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Select Action</label>
          <div class="btn-group" role="group" aria-label="List Action">
              <input type="radio" class="btn-check" name="listAction" id="addList" autocomplete="off" value="add" required>
              <label class="btn btn-outline-secondary" for="addList">Add</label>

              <input type="radio" class="btn-check" name="listAction" id="removeList" autocomplete="off" value="remove" required>
              <label class="btn btn-outline-secondary" for="removeList">Remove</label>
          </div>
        </div>

        <div id="addListContent" style="display: none;"> 
          <form action="{{ route('add.to.favorites') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="favoriteList" class="form-label">Add to WatchList:</label>
              <select class="form-select" id="favoriteList" name="favoriteList">
                @auth
                  @if ($favoriteLists->isEmpty())
                      <option value="">You don't have none</option>
                  @else
                      <option value="">Choose one</option>
                      @foreach ($favoriteLists as $favoriteList)
                          <option value="{{ $favoriteList->id }}">{{ $favoriteList->name }}</option>
                      @endforeach
                  @endif
                @endauth
            </select>
            </div>
            <div class="mb-3">
              <label for="newListName" class="form-label">Create a new one:</label>
              <input type="text" class="form-control" id="newListName" name="newListName">
            </div>
            <input type="hidden" id="multimediaIdToAdd" name="multimedia_id" value="">
            <div class="modal-footer" style="background-color: rgba(31,33,34,0.95);">
              <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Add</button>
            </div>
          </form>
        </div>

        <div id="removeListContent" style="display: none;">
          <form action="{{ route('remove.from.favorites') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="favoriteList" class="form-label">Select Favorite List:</label>
              <select class="form-select" id="favoriteList" name="favoriteList">
                @foreach ($favoriteLists as $favoriteList)
                    <option value="{{ $favoriteList->id }}">{{ $favoriteList->name }}</option>
                @endforeach
              </select>
            </div>
            <input type="hidden" id="multimediaIdToRemove" name="multimedia_id" value="">
            <div class="modal-footer" style="background-color: rgba(31,33,34,0.95);">
              <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Remove</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

{{-- Conteudo da pagina, atras são os modais  --}}

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
                    <div>
                    <img src="{{asset('assets/front-section/images/tape.jpg')}}"  alt="" style="border-radius: 5px; max-height: 75px;">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ***** All movies Start ***** -->
        <div class="most-popular">
          <div class="row">
            <div class="col-lg-12">
              <div class="heading-section d-flex justify-content-between align-items-center">
                <h4><em>All</em> Media Collection</h4>
                <div>
                  <form id="search" action="#" style="position: relative;">
                    <input type="text" style="background-color: #27292a; height: 46px; border-radius: 23px; border: none; color: #666; font-size: 14px; padding: 0px 15px 0px 45px;" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                    <i class="fa fa-search" style="position: absolute; color: #666;left: 20px; top: 16px; width: 18px; height: 18px; font-size: 16px;"></i>
                  </form>
                </div>
                <div class="filter-links">
                  <form method="GET" action="{{ route('movies.all') }}" class="row align-items-center">
                      <div class="col-auto mb-4">
                          <label for="sort" class="form-label" style="color: #e75e8d; font-weight: bold;">Sort by:</label>
                          <select name="sort" id="sort" class="form-select">
                              <option value="imdb_votes">Votes</option>
                              <option value="imdb_rating">Rating</option>
                              <option value="released">Released</option>
                          </select>
                      </div>
                      <div class="col-auto mb-4">
                          <label for="order" class="form-label" style="color: #e75e8d; font-weight: bold;">Order:</label>
                          <select name="order" id="order" class="form-select">
                              <option value="asc">Ascending</option>
                              <option value="desc">Descending</option>
                          </select>
                      </div>
                      <div class="col-auto">
                          <button type="submit" class="btn btn" style="background-color: #e75e8d; color: white;">Sort</button>
                      </div>
                  </form>
                </div>
              </div>
              <!-- ***** Search End ***** -->
              {{-- <div class="search-input">
                <form id="search" action="#">
                  <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                  <i class="fa fa-search"></i>
                </form>
              </div> --}}
              <!-- ***** Search End ***** -->

              <div class="row" id="movies-container">
                @foreach ($multimedia as $media)
                <div class="col-lg-3 col-sm-6">
                  <div class="item">
                    <a href="{{ route('movies.show', $media->id) }}">
                      <img src="{{ $media->poster ? $media->poster : asset('assets/front-section/images/default.jpg') }}" alt="">
                      <h4>{{ $media->title }}<br><span><strong> Released: {{ $media->released }}</strong></span></h4>
                    </a>
                    <ul>
                      <li>
                        <p style="color: white;">IMDb : {{ $media->imdb_rating ? $media->imdb_rating : 'N/A' }} <i class="fa fa-star"></i></p>
                        <p style="color: white;">Metascore : {{ $media->metascore ? $media->metascore : 'N/A' }} <i class="fa fa-star" style="color: #ec6090;" ></i></p>
                      </li>
                      <li>
                        @auth
                          {{-- Verificar se o user ja tem nos favoritos ou não --}}
                          @if (in_array($media->id, $favoriteMultimediaIds))
                            <button type="button" class="btn btn-link manageFavoritesButton" data-bs-toggle="modal" data-bs-target="#manageFavoritesModal" data-multimedia-id="{{ $media->id }}">
                              <i class="fa fa-bookmark fa-2x" style="color: white; margin-top: -10px;"></i>
                            </button>
                          @else
                            <button type="button" class="btn btn-link addToFavoritesButton" data-bs-toggle="modal" data-bs-target="#addToFavoritesModal" data-multimedia-id="{{ $media->id }}">
                              <i class="fa fa-bookmark-o fa-2x" style="color: white; margin-top: -10px;"></i>
                            </button>
                          @endif

                          {{-- Verificar se o user ja deu like --}}
                          @if (Auth::user()->likes()->where('multimedia_id', $media->id)->exists())
                            <form action="{{ route('unlike', $media) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-link">
                                <i class="fa fa-thumbs-up fa-2x" style="color: white; margin-top: -10px;"></i>
                              </button>
                            </form>
                          @else
                            <form action="{{ route('like', $media) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                  <i class="fa fa-thumbs-o-up fa-2x" style="color: white; margin-top: -10px;"></i>
                                </button>
                            </form>
                          @endif
                        @else
                          <a href="{{ url('/no-account') }}"><i class="fa fa-bookmark-o fa-2x" style="color: white;"></i></a>
                          <span style="margin: 5px 10px;"></span>
                          <a href="{{ url('/no-account-like') }}"><i class="fa fa-thumbs-o-up fa-2x" style="color: white;"></i></a>
                        @endauth
                      </li>
                    </ul>
                  </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-center">
                  <div class="bg rounded h-100 p-4">
                      <ul class="pagination">
                          <!-- Link para a página anterior -->
                          @if ($multimedia->onFirstPage())
                              <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                          @else
                              <li class="page-item"><a class="page-link" href="{{ $multimedia->previousPageUrl() }}" rel="prev" style="color: #000000;">&laquo;</a></li>
                          @endif
              
                          <!-- Links das páginas -->
                          @for ($i = 1; $i <= $multimedia->lastPage(); $i++)
                              <li class="page-item {{ $i === $multimedia->currentPage() ? 'active' : '' }}">
                                  <a class="page-link {{ $i === $multimedia->currentPage() ? 'active-link' : 'inactive-link' }}" href="{{ $multimedia->url($i) }}" style="{{ $i === $multimedia->currentPage() ? 'background-color: #ec6090; border-color: #ec6090; color: #fff;' : 'color: #000000;' }}">{{ $i }}</a>
                              </li>
                          @endfor
              
                          <!-- Link para a próxima página -->
                          @if ($multimedia->hasMorePages())
                              <li class="page-item"><a class="page-link" href="{{ $multimedia->nextPageUrl() }}" rel="next" style="color: #000000;">&raquo;</a></li>
                          @else
                              <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                          @endif
                      </ul>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- ***** All movies End ***** -->

      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Adiciona um evento de clique para o botão do bookmark
  document.querySelectorAll('.addToFavoritesButton').forEach(function(button) {
      button.addEventListener('click', function() {
          var multimediaId = this.getAttribute('data-multimedia-id'); // Obtém o ID do multimedia
          document.getElementById('multimediaIdInput').value = multimediaId; // Define o valor do campo oculto no modal
      });
  });

  // Adiciona um evento de clique para os botões de adicionar e remover
  document.querySelectorAll('.manageFavoritesButton').forEach(function(button) {
      button.addEventListener('click', function() {
          var multimediaId = this.getAttribute('data-multimedia-id');
          document.getElementById('multimediaIdToAdd').value = multimediaId;
          document.getElementById('multimediaIdToRemove').value = multimediaId;
      });
  });

  // Adiciona um evento de clique para os botões de adicionar e remover dentro do modal
  document.querySelectorAll('.manageFavoritesModalButton').forEach(function(button) {
      button.addEventListener('click', function() {
          var action = this.getAttribute('data-action');
          if (action === 'add') {
              var multimediaId = document.getElementById('multimediaIdToAdd').value;
              // Enviar o formulário com o ID da multimídia e a ação de adicionar
          } else if (action === 'remove') {
              var multimediaId = document.getElementById('multimediaIdToRemove').value;
              // Enviar o formulário com o ID da multimídia e a ação de remover
          }
      });
  });

  //mudança de manage modal
  $(document).ready(function() {
        $('input[name="listAction"]').change(function() {
            var selectedAction = $(this).val();

            if (selectedAction === 'add') {
                $('#addListContent').show();
                $('#removeListContent').hide();
            } else if (selectedAction === 'remove') {
                $('#addListContent').hide();
                $('#removeListContent').show();
            }
        });
    });
</script>

@endsection
