<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Types</h4>
            <form action="{{ route('admin.types') }}" method="GET" class="d-none d-md-flex">
                <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
                <button type="submit"  class="btn btn-primary">Search</button>
            </form>
            <a class="btn btn-m btn-primary" href="{{ route('admin.types.create') }}">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Id</th>
                        <th scope="col">
                            Name 
                            <a href="{{ route('admin.types', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'name' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($type as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td data-bs-toggle="modal" data-bs-target="#TypeModal" class="modal-trigger delete-modal-trigger" data-id="{{ $item->id }}" data-name="{{ $item->name }}">{{ $item->name }}</td>
                        <td>
                            <div class="navbar-nav align-items-center ms-auto">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="d-none d-lg-inline-flex">Actions</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end bg-dark border-0 rounded-0 rounded-bottom m-0">
                                        <a href="{{ route('admin.types.edit', ['id' => $item->id]) }}" class="dropdown-item">
                                            <h6 class="fw-normal mb-0" style="color: red;" >Update</h6>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a href="#" class="dropdown-item delete-modal-trigger" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#TypeDeleteModal">
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
                        @if ($type->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $type->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif
                
                        <!-- Links das páginas -->
                        @for ($i = 1; $i <= $type->lastPage(); $i++)
                            <li class="page-item {{ $i === $type->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $type->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                
                        <!-- Link para a próxima página -->
                        @if ($type->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $type->nextPageUrl() }}" rel="next">&raquo;</a></li>
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
<div class="modal fade" id="TypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="TypeModalLabel">Type Details ID: <span id="modalid"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong class="text-white">Name: </strong><span id="modalName"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exclusão -->
<div class="modal fade" id="TypeDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TypeDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="TypeDeleteModalLabel">Delete Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Type ?</p>
                <form id="deleteTypeForm" method="POST" action="{{ route('admin.types.delete', ['id' => $item->id]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteTypeId" name="id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('TypeModal'));
        var deleteModal = new bootstrap.Modal(document.getElementById('TypeDeleteModal'));

        document.querySelectorAll('.modal-trigger').forEach(function (item) {
            item.addEventListener('click', function (event) {
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                document.getElementById('modalid').innerText = id;
                document.getElementById('modalName').innerText = name;
                myModal.show();
            });
        });

        document.querySelectorAll('.delete-modal-trigger').forEach(function (item) {
            item.addEventListener('click', function (event) {
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                document.getElementById('deleteTypeId').value = id;
                document.getElementById('modalDeleteName').innerText = name;
                var form = document.getElementById('deleteTypeForm');
                form.action = '{{ url("admin/types/delete") }}/' + id; // Atualiza a ação do formulário com a URL correta
                deleteModal.show();
            });
        });
    });
</script>