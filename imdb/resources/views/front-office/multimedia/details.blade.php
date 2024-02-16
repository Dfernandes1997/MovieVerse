@extends('front-office.layout')

@section('content')

<!-- Modal Add Favorites -->
<!-- Modal manage Favorites -->

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
                  @if (in_array($movie->id, $favoriteMultimediaIds))
                  <form method="POST" action="{{ route('favorites.remove', ['multimediaFavoritosId' => $movie->favoritos->first()->pivot->id]) }}" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link"><i class="fa fa-bookmark fa-3x" style="color: white;"></i></button>
                  </form>
                  @else
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#addToFavoritesModal">
                      <i class="fa fa-bookmark-o fa-3x" style="color: white;"></i>
                    </button>
                  @endif
                @else
                  <a href="{{ url('/no-account') }}"><i class="fa fa-bookmark-o fa-1x" style="color: white;"></i></a>
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
                            @else
                              <a href="{{ url('/no-account-comment') }}">
                                <i class="fa fa-reply fa-2x" style="color: white;"></i>
                              </a>
                              <p>Reply</p>
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

</script>

@endsection