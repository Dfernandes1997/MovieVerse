<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Multimedia</h4>
            <form action="{{ route('admin.multimedia') }}" method="GET" class="d-none d-md-flex">
                <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
                <button type="submit"  class="btn btn-primary">Search</button>
            </form> 
            <a class="btn btn-m btn-primary" href="{{ route('admin.multimedia.create') }}">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Id</th>
                        <th scope="col">
                            Title 
                            <a href="{{ route('admin.multimedia', ['sort' => 'title', 'order' => $sort === 'title' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'title' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">
                            Year 
                            <a href="{{ route('admin.multimedia', ['sort' => 'year', 'order' => $sort === 'year' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'year' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">
                            Country 
                            <a href="{{ route('admin.multimedia', ['sort' => 'country', 'order' => $sort === 'country' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'country' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">
                            IMDb Rating 
                            <a href="{{ route('admin.multimedia', ['sort' => 'imdb_rating', 'order' => $sort === 'imdb_rating' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'imdb_rating' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">
                            IMDb Votes 
                            <a href="{{ route('admin.multimedia', ['sort' => 'imdb_votes', 'order' => $sort === 'imdb_votes' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'imdb_votes' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($multimedia as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td data-bs-toggle="modal" data-bs-target="#MultimediaModal" class="modal-trigger delete-modal-trigger" data-id="{{ $item->id }}" data-title="{{ $item->title }}" data-year="{{ $item->year }}" data-released="{{ $item->released }}" data-runtime="{{ $item->runtime }}" data-plot="{{ $item->plot }}" data-language="{{ $item->language }}" data-country="{{ $item->country }}" data-awards="{{ $item->awards }}" data-box_office="{{ $item->box_office }}" data-type_id="{{ $item->type_id }}" data-metascore="{{ $item->metascore }}" data-imdb_rating="{{ $item->imdb_rating }}" data-imdb_votes="{{ $item->imdb_votes }}">
                            {{ $item->title }}
                        </td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->country }}</td>
                        <td>{{ $item->imdb_rating }}</td>
                        <td>{{ $item->imdb_votes }}</td>
                        <td>
                            <div class="navbar-nav align-items-center ms-auto">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="d-none d-lg-inline-flex">Actions</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end bg-dark border-0 rounded-0 rounded-bottom m-0">
                                        <a href="{{ route('admin.multimedia.edit', ['id' => $item->id]) }}" class="dropdown-item">
                                            <h6 class="fw-normal mb-0" style="color: red;" >Update</h6>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a href="#" class="dropdown-item delete-modal-trigger" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#MultimediaDeleteModal">
                                            <h6 class="fw-normal mb-0" style="color: red;" >Delete</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center">
                <div class="bg-secondary rounded h-100 p-4">
                    <ul class="pagination">
                        <!-- Link para a página anterior -->
                        @if ($multimedia->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $multimedia->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif
                
                        <!-- Links das páginas -->
                        @for ($i = 1; $i <= $multimedia->lastPage(); $i++)
                            <li class="page-item {{ $i === $multimedia->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $multimedia->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                
                        <!-- Link para a próxima página -->
                        @if ($multimedia->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $multimedia->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            </div>    

        </div>
    </div>
</div>

<!-- Modal Informativo -->
<div class="modal fade" id="MultimediaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="MultimediaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="MultimediaModalLabel">Multimedia Details ID: <span id="modalid"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong class="text-white">Title: </strong><span id="modalTitle"></span></p>
                <p><strong class="text-white">Year: </strong><span id="modalYear"></span></p>
                <p><strong class="text-white">Released: </strong><span id="modalReleased"></span></p>
                <p><strong class="text-white">Run Time: </strong><span id="modalRuntime"></span></p>
                <p><strong class="text-white">Plot: </strong><span id="modalPlot"></span></p>
                <p><strong class="text-white">Language: </strong><span id="modalLanguage"></span></p>
                <p><strong class="text-white">Country: </strong><span id="modalCountry"></span></p>
                <p><strong class="text-white">Awards: </strong><span id="modalAwards"></span></p>
                <p><strong class="text-white">Box Office: </strong><span id="modalBoxOffice"></span></p>
                <p><strong class="text-white">Type Id: </strong><span id="modalTypeId"></span></p>
                <p><strong class="text-white">Metascore: </strong><span id="modalMetascore"></span></p>
                <p><strong class="text-white">Imdb Rating: </strong><span id="modalImdbRating"></span></p>
                <p><strong class="text-white">Imdb Votes: </strong><span id="modalImdbVotes"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exclusão -->
<div class="modal fade" id="MultimediaDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="MultimediaDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="MultimediaDeleteModalLabel">Delete Multimedia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this multimedia ?</p>
                <form id="deleteMultimediaForm" method="POST" action="{{ route('admin.multimedia.delete', ['id' => $item->id]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteMultimediaId" name="id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('MultimediaModal'));
        var deleteModal = new bootstrap.Modal(document.getElementById('MultimediaDeleteModal'));

        document.querySelectorAll('.modal-trigger').forEach(function (item) {
            item.addEventListener('click', function (event) {
                var id = this.getAttribute('data-id');
                var title = this.getAttribute('data-title');
                var year = this.getAttribute('data-year');
                var released = this.getAttribute('data-released');
                var runtime = this.getAttribute('data-runtime');
                var plot = this.getAttribute('data-plot');
                var language = this.getAttribute('data-language');
                var country= this.getAttribute('data-country');
                var awards = this.getAttribute('data-awards');
                var box_office = this.getAttribute('data-box_office');
                var type_id = this.getAttribute('data-type_id');
                var metascore = this.getAttribute('data-metascore');
                var imdb_rating= this.getAttribute('data-imdb_rating');
                var imdb_votes = this.getAttribute('data-imdb_votes');
                document.getElementById('modalid').innerText = id;
                document.getElementById('modalTitle').innerText = title;
                document.getElementById('modalYear').innerText = year;
                document.getElementById('modalReleased').innerText = released;
                document.getElementById('modalRuntime').innerText = runtime;
                document.getElementById('modalPlot').innerText = plot;
                document.getElementById('modalLanguage').innerText = language;
                document.getElementById('modalCountry').innerText = country;
                document.getElementById('modalAwards').innerText = awards
                document.getElementById('modalBoxOffice').innerText = box_office;
                document.getElementById('modalTypeId').innerText = type_id;
                document.getElementById('modalMetascore').innerText = metascore;
                document.getElementById('modalImdbRating').innerText = imdb_rating;
                document.getElementById('modalImdbVotes').innerText = imdb_votes;
                myModal.show();
            });
        });

        document.querySelectorAll('.delete-modal-trigger').forEach(function (item) {
            item.addEventListener('click', function (event) {
                var id = this.getAttribute('data-id');
                var title = this.getAttribute('data-title');
                console.log('Título:', title);
                document.getElementById('deleteMultimediaId').value = id;
                document.getElementById('modalDeleteTitle').innerText = title;
                var form = document.getElementById('deleteMultimediaForm');
                form.action = '{{ url("admin/multimedia/delete") }}/' + id; // Atualiza a ação do formulário com a URL correta
                deleteModal.show();
            });
        });
    });
</script>
