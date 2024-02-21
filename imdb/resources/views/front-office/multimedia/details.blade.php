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

<!-- Modal Comment -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
      <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
        <h5 class="modal-title" id="commentModalLabel">Add Comment <i class="fa fa-commenting-o"></i></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" style="background-color: #ec6090;"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('comments.store') }}" method="POST">
          @csrf
          <input type="hidden" name="user_id" value="{{ auth()->id() }}">
          <input type="hidden" name="multimedia_id" value="{{ $id }}">
          <input type="hidden" name="parent_id" id="parent_id" value="">
          <div class="mb-3">
            <label for="commentText" class="form-label">Text:</label>
            <textarea class="form-control" id="commentText" name="comment_text" rows="3" required></textarea>
          </div>
          <div class="modal-footer" style="background-color: rgba(31,33,34,0.95);">
            <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Comment</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar comment (continuar)-->
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
          <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
              <h5 class="modal-title" id="editCommentModalLabel">Edit Comment <i class="fa fa-pencil edit-comment"></i></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #ec6090;"></button>
          </div>
          <div class="modal-body">
              <form id="editCommentForm" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                      <label for="newComment" class="form-label">Comment</label>
                      <input type="hidden" id="editCommentId" name="commentId">
                      <input type="text" class="form-control" id="editComment" name="newComment">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn" onclick="document.getElementById('editCommentForm').submit()" style="background-color: #ec6090; color: white;">Edit</button>
          </div>
      </div>
  </div>
</div>

<!-- Modal de confirmação para excluir comment (continuar)-->
<div class="modal fade" id="confirmDeleteCommentModal" tabindex="-1" aria-labelledby="confirmDeleteCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content" style="background-color: rgba(31,33,34,0.95); color: white;">
          <div class="modal-header" style="background-color: rgba(31,33,34,0.95); color: white;">
              <h5 class="modal-title" id="confirmDeleteCommentModalLabel">Confirm Delete Comment <i class="fa fa-trash delete-comment"></i></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #ec6090;"></button>
          </div>
          <div class="modal-body" id="confirmDeleteCommentModalBody">
              Sure you want to delete this Comment and Replys ?
          </div>
          <div class="modal-footer">
              <form id="confirmDeleteCommentForm" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" id="deleteCommentId" name="CommentId">
                  <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Delete</button>
              </form>
          </div>
      </div>
  </div>
</div>



<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <!-- ***** Trailer/image Start ***** -->
        <div class="row">
          <div class="col-lg-12">
            <div class="feature-banner header-text">
              <div class="row">
                <div class="col-lg-4">
                  <img src="{{ $movie->poster ? $movie->poster : asset('assets/front-section/images/default.jpg') }}" alt="" style="border-radius: 23px; width: 300px; height: 320px;">
                </div>
                <div class="col-lg-8">
                  <div class="thumb">
                    <img src="{{asset('assets/front-section/images/trailer.jpg')}}" alt="" style="border-radius: 23px;">
                    <?php $youtubeSearchQuery = urlencode($movie->title . ' trailer'); $youtubeURL = 'https://www.youtube.com/results?search_query=' . $youtubeSearchQuery; ?>
                    <a href="<?php echo $youtubeURL; ?>" target="_blank"><i class="fa fa-play"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Trailer/image End ***** -->

        <!-- ***** Details Start ***** -->
        <div class="game-details">
          <div class="row">
            <div class="col-lg-12">
              <h2>{{ $movie->title }} <span style="color: #e75e8d;"> Details</span>
                @auth
                <div class="d-inline-flex">
                  {{-- Verificar se o user ja tem nos favoritos ou não --}}
                  @if (in_array($movie->id, $favoriteMultimediaIds))
                    <button type="button" class="btn btn-link manageFavoritesButton" data-bs-toggle="modal" data-bs-target="#manageFavoritesModal" data-multimedia-id="{{ $movie->id }}">
                      <i class="fa fa-bookmark fa-3x" style="color: white;"></i>
                    </button>
                  @else
                    <button type="button" class="btn btn-link addToFavoritesButton" data-bs-toggle="modal" data-bs-target="#addToFavoritesModal" data-multimedia-id="{{ $movie->id }}">
                      <i class="fa fa-bookmark-o fa-3x" style="color: white;"></i>
                    </button>
                  @endif

                  {{-- Verificar se o user ja deu like --}}
                  @if (Auth::user()->likes()->where('multimedia_id', $movie->id)->exists())
                    <form action="{{ route('unlike', $movie) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link">
                        <i class="fa fa-thumbs-up fa-3x" style="color: white; margin-left: -10px;"></i>
                      </button>
                    </form>
                  @else
                    <form action="{{ route('like', $movie) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link">
                          <i class="fa fa-thumbs-o-up fa-3x" style="color: white; margin-left: -10px;"></i>
                        </button>
                    </form>
                  @endif
                </div>
                @else
                  <a href="{{ url('/no-account') }}"><i class="fa fa-bookmark-o fa-1x" style="color: white;"></i></a>
                  <a href="{{ url('/no-account-like') }}"><i class="fa fa-thumbs-o-up fa-1x" style="color: white;"></i></a>
                @endauth
              </h2>                
              <div class="d-flex justify-content-center mt-3 mb-5">
                @foreach($genres as $genre)
                    <button class="btn btn-info mx-2"><strong>{{ $genre }}</strong></button>
                @endforeach
              </div>
            </div>
            <div class="col-lg-12">
              <div class="content">
                <div class="heading-section">
                  <h4>Info</h4>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="left-info">
                      <div class="left">
                        <span><strong> Type: </strong>{{ ucfirst($movie->type->name)}}</span>
                        <span><strong> Released: </strong>{{ $movie->released ? $movie->released : 'N/A'}}</span>
                        <span><strong> RunTime: </strong>{{ $movie->runtime ? $movie->runtime : 'N/A'}}</span>
                        <span><strong> BoxOffice: </strong>{{ $movie->box_office ? $movie->box_office : 'N/A'}}</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="right-info">
                      <ul>
                        <li><i class="fa fa-star"></i>{{ $movie->imdb_rating ? $movie->imdb_rating : 'N/A'}}</li>
                        <li><i class="fa fa-users"></i>{{ number_format($movie->imdb_votes) }}</li>
                        <li><i class="fa fa-language"></i>{{ $movie->language ? $movie->language : 'N/A'}}</li>
                        <li><i class="fa fa-globe"></i>{{ $movie->country ? $movie->country : 'N/A'}}</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <p style="color: white;">{{ $movie->plot }}</p>
                  </div>
                  <div class="d-flex justify-content-center mt-5 mb-2">
                    <div class="right-info">
                      <ul>
                        <strong><p> <i class="fa fa-trophy" style="color: yellow; margin-right: 10px;"></i>{{ $movie->awards ? $movie->awards : 'N/A'}}</p></strong>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Cast Start ***** -->
            <div class="gaming-library">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4>Cast</h4>
                </div>
                @foreach ($groupedCast as $role => $persons)
                  <div class="item">
                      <ul>
                          @if ($role === 'Director')
                              <li><i class="fa fa-video-camera fa-2x" style="color: white;"></i></li>
                              <li><h4>Director :</h4></li>
                          @elseif ($role === 'Writer')
                              <li><i class="fa fa-pencil-square fa-2x" style="color: white;"></i></li>
                              <li><h4>Writer :</h4></li>
                          @elseif ($role === 'Actor')
                              <li><i class="fa fa-users fa-2x" style="color: white;"></i></li>
                              <li><h4>Actor :</h4></li>
                          @endif
                          @php $count = 0; @endphp
                          @foreach ($persons as $person)
                              @if ($count % 2 == 0)
                                  <li>
                              @endif
                              <h4>{{ $person->name }}</h4>
                              @php $count++; @endphp
                              @if ($count % 2 == 0)
                                  </li>
                              @endif
                          @endforeach
                          @if ($count % 2 != 0)
                              </li>
                          @endif
                      </ul>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- ***** Cast End ***** -->
          </div>
        </div>
        <!-- ***** Details End ***** -->


        <!-- ***** Suggested media start ***** -->
        <div class="live-stream">
          <div class="col-lg-12">
            <div class="heading-section">
              <h4><em>Related</em> Media</h4>
            </div>
          </div>
          <div class="row">
            @foreach ($relatedMovies as $relatedMovie)
            <div class="col-lg-3 col-sm-6">
              <div class="item">
                <div class="thumb">
                  <img src="{{ $relatedMovie->poster ? $relatedMovie->poster : asset('assets/front-section/images/default.jpg') }}" alt="">
                  <div class="hover-effect">
                    <div class="content">
                      <div class="live">
                        <a href="{{ route('movies.show', $relatedMovie->id) }}">See More</a>
                      </div>
                      <ul>
                        <li><a href=""><i class="fa fa-star"></i> {{ $relatedMovie->imdb_rating ? $relatedMovie->imdb_rating : 'N/A' }}</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i> {{ $relatedMovie->runtime ? $relatedMovie->runtime : 'N/A' }}</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="down-content">
                  <h6>{{ $relatedMovie->title }}</h6>
                  <span><i class="fa fa-calendar"></i>{{ $relatedMovie->released ? $relatedMovie->released : 'N/A'}}</span>
                </div> 
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <!-- ***** Suggested Media End ***** -->


        <!-- ***** Comments section Start ***** -->
        <div class="gaming-library profile-library">
          <div class="col-lg-12">
              <div class="heading-section d-flex justify-content-between align-items-center">
                  <h4><em>Comments</em> Section <i class="fa fa-comments"></i></h4>
                  <div class="col-auto">
                    @auth
                      <button type="button" class="btn btn" style="background-color: #e75e8d; color: white;" data-bs-toggle="modal" data-bs-target="#commentModal">New Comment</button>
                    @else
                      <a href="{{ url('/no-account-comment') }}" class="btn btn" style="background-color: #e75e8d; color: white;">New Comment</a>
                    @endauth
                  </div>
              </div>

              @if ($comments->count() > 0)
              <div class="container mb-5 mt-5">
                  @foreach ($comments as $comment)
                  <!-- Main Comments -->
                  <div class="comment col-lg-10" style="border-radius: 10px; padding: 10px; border: 1px solid #444;">
                      <div class="comment-header d-flex align-items-center justify-content-between">
                          <div class="user-info">
                              <i class="fa fa-user-circle fa-3x mr-3 mb-2" style="color: white;"></i>
                              <div>
                                  <h5 style="color: #e75e8d;">{{ $comment->user->name }} <small><i class="fa fa-commenting-o"></i></small></h5>
                                  <p> {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                              </div>
                          </div>
                          <div>
                            @auth
                              <button type="button" class="btn btn-link commentsButton" data-bs-toggle="modal" data-bs-target="#commentModal" data-comment-id="{{ $comment->id }}">
                                <i class="fa fa-reply fa-2x" style="color: white;"></i>
                              </button>
                              <p>Reply</p>
                              @if(auth()->id() == $comment->user_id)
                                <i class="fa fa-pencil edit-comment mt-3" data-bs-toggle="modal" data-bs-target="#editCommentModal" style="color: white; font-size: 20px;" data-comment-id="{{ $comment->id }}"></i>
                                <i class="fa fa-trash delete-comment" data-bs-toggle="modal" data-bs-target="#confirmDeleteCommentModal" style="color: white; font-size: 20px;" data-comment-id="{{ $comment->id }}"></i>
                              @endif
                              @if(auth()->id() != $comment->user_id)
                                {{-- Verificar se o user ja deu like no comment --}}
                                @if (Auth::user()->commentLikes()->where('comment_id', $comment->id)->exists())
                                <form action="{{ route('commentunlike', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link" style="text-decoration: none; color: white; background: none; border: none;">
                                      <p style="color: white; font-size: 25px;"><i class="fa fa-thumbs-up"></i> {{$comment->likes}}</p>
                                    </button>
                                  </form>
                                @else
                                  <form action="{{ route('commentlike', $comment) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link" style="text-decoration: none; color: white; background: none; border: none;">
                                      <p style="color: white; font-size: 25px;"><i class="fa fa-thumbs-o-up"></i> {{$comment->likes}}</p>
                                    </button>
                                  </form>
                                @endif
                              @endif
                            @else
                              <a href="{{ url('/no-account-comment') }}">
                                <i class="fa fa-reply fa-2x" style="color: white;"></i>
                              </a>
                              <p>Reply</p>
                              <a href="{{ url('/no-account-like') }}"><i class="fa fa-thumbs-o-up" style="color: white; font-size: 25px;"></i> {{$comment->likes}}</a>
                            @endauth
                          </div>
                      </div>
                      <div class="comment-content">
                          <h6>{{ $comment->content }}</h6>
                      </div>
                  </div> 

                  <!-- Replies -->
                  @if ($comment->children->count() > 0)
                  <div class="reply ml-5 mt-3">
                      <!-- Replies -->
                      @foreach ($comment->children as $child)
                      <div class="col-lg-10 offset-lg-2">
                          <div class="comment col-lg-9 mt-3" style="border-radius: 10px; padding: 10px; border: 1px solid #444;">
                              <div class="comment-header d-flex align-items-center justify-content-between">
                                  <div class="user-info">
                                      <i class="fa fa-user-circle fa-2x mr-3 mb-2" style="color: white;"></i>
                                      <div>
                                          <h5 style="color: #e75e8d;">{{ $child->user->name }} <small> reply:</small></h5>
                                          <p>- {{ $child->created_at->format('d/m/Y H:i') }}</p>
                                      </div>
                                  </div>
                                  <div>
                                    @auth
                                      @if(auth()->id() == $child->user_id)
                                        <i class="fa fa-pencil edit-comment" data-bs-toggle="modal" data-bs-target="#editCommentModal" style="color: white; font-size: 20px;" data-comment-id="{{ $child->id }}"></i>
                                        <i class="fa fa-trash delete-comment" data-bs-toggle="modal" data-bs-target="#confirmDeleteCommentModal" style="color: white; font-size: 20px;" data-comment-id="{{ $child->id }}"></i>
                                      @endif
                                      @if(auth()->id() != $child->user_id)
                                        {{-- Verificar se o user ja deu like no comment --}}
                                        @if (Auth::user()->commentLikes()->where('comment_id', $child->id)->exists())
                                        <form action="{{ route('commentunlike', $child) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link" style="text-decoration: none; color: white; background: none; border: none;">
                                              <p style="color: white; font-size: 25px;"><i class="fa fa-thumbs-up"></i> {{$child->likes}}</p>
                                            </button>
                                          </form>
                                        @else
                                          <form action="{{ route('commentlike', $child) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link" style="text-decoration: none; color: white; background: none; border: none;">
                                              <p style="color: white; font-size: 25px;"><i class="fa fa-thumbs-o-up"></i> {{$child->likes}}</p>
                                            </button>
                                          </form>
                                        @endif
                                      @endif
                                    @else
                                      <a href="{{ url('/no-account-like') }}"><i class="fa fa-thumbs-o-up" style="color: white; font-size: 25px;"></i> {{$child->likes}}</a>
                                    @endauth
                                  </div>
                              </div>
                              <div class="comment-content">
                                  <h6>{{ $child->content }}</h6>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>
                  @endif
              </div>
              @endforeach
              @else
              <div class="comment col-lg-8" style="border-radius: 10px; padding: 10px; border: 1px solid #444;">
                <div class="comment-header d-flex align-items-center justify-content-between">
                  <div>
                      <h6>No comments yet.</h6>
                      <span style="color: white;"></span>
                  </div>
              </div>
              @endif
          </div>
        </div>
        <!-- ***** Comments section End ***** -->

      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  // Captura o parent_id quando carregar no icone reply
  document.querySelectorAll('.commentsButton').forEach(function(button) {
    button.addEventListener('click', function() {
        var commentId = this.getAttribute('data-comment-id');
        document.getElementById('parent_id').value = commentId;
    });
  });

  // Captura o evento de clique no ícone (editar)
  document.querySelectorAll('.edit-comment').forEach(function (editIcon) {
    editIcon.addEventListener('click', function () {
        var commentId = this.getAttribute('data-comment-id');
        var comment = this.getAttribute('data-comment');
        // Passar os dados do comment para o modal de edição
        document.getElementById('editCommentId').value = commentId;
        document.getElementById('editComment').value = comment;

        // Define o action do formulário de edição dinamicamente
        document.getElementById('editCommentForm').action = "{{ route('comments.update', '') }}" + "/" + commentId;
    });
  });

  // Captura o evento de clique no ícone (excluir)
  document.querySelectorAll('.delete-comment').forEach(function (deleteIcon) {
    deleteIcon.addEventListener('click', function () {
        var CommentId = this.getAttribute('data-comment-id');
        var comment = this.getAttribute('data-comment-name');

        // Passar os dados do comment para o modal de exclusão
        document.getElementById('deleteCommentId').value = CommentId;

        var formAction = "{{ route('comments.destroy', '') }}" + "/" + CommentId;
        console.log('Form Action: ', formAction);
        // Define o action do formulário de exclusão dinamicamente
        document.getElementById('confirmDeleteCommentForm').action = "{{ route('comments.destroy', '') }}" + "/" + CommentId;
    });
  });

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