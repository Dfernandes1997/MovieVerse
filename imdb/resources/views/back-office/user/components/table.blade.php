<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Users</h4>
            <form action="{{ route('admin.users') }}" method="GET" class="d-none d-md-flex">
                <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
                <button type="submit"  class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Id</th>
                        <th scope="col">
                            Username 
                            <a href="{{ route('admin.users', ['sort' => 'username', 'order' => $sort === 'username' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'username' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">
                            Name 
                            <a href="{{ route('admin.users', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'name' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">
                            Email 
                            <a href="{{ route('admin.users', ['sort' => 'email', 'order' => $sort === 'email' && $order === 'asc' ? 'desc' : 'asc']) }}">
                                <i class="fas {{ $sort === 'email' && $order === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                            </a>
                        </th>
                        <th scope="col">Admin</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td data-bs-toggle="modal" data-bs-target="#UsersModal" class="modal-trigger delete-modal-trigger" data-id="{{ $item->id }}" data-username="{{ $item->username }}" data-name="{{ $item->name }}" data-email="{{ $item->email }}" data-is_admin="{{ $item->is_admin }}">{{ $item->username }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->is_admin}}</td>
                        <td>
                            <div class="navbar-nav align-items-center ms-auto">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="d-none d-lg-inline-flex">Actions</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end bg-dark border-0 rounded-0 rounded-bottom m-0">
                                        <a href="{{ route('admin.users.edit', ['id' => $item->id]) }}" class="dropdown-item">
                                            <h6 class="fw-normal mb-0" style="color: red;" >Update</h6>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a href="#" class="dropdown-item delete-modal-trigger" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#UsersDeleteModal">
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
                        @if ($user->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $user->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif
                
                        <!-- Links das páginas -->
                        @for ($i = 1; $i <= $user->lastPage(); $i++)
                            <li class="page-item {{ $i === $user->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $user->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                
                        <!-- Link para a próxima página -->
                        @if ($user->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $user->nextPageUrl() }}" rel="next">&raquo;</a></li>
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
<div class="modal fade" id="UsersModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="UsersModalLabel">Users Details ID: <span id="modalid"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong class="text-white">Username: </strong><span id="modalUsername"></span></p>
                <p><strong class="text-white">Name: </strong><span id="modalName"></span></p>
                <p><strong class="text-white">Email: </strong><span id="modalEmail"></span></p>
                <p><strong class="text-white">Admin: </strong><span id="modalAdmin"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exclusão -->
<div class="modal fade" id="UsersDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UsersDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="UsersDeleteModalLabel">Delete Users</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user ?</p>
                <form id="deleteUsersForm" method="POST" action="{{ route('admin.users.delete', ['id' => $item->id]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteUsersId" name="id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('UsersModal'));
        var deleteModal = new bootstrap.Modal(document.getElementById('UsersDeleteModal'));

        document.querySelectorAll('.modal-trigger').forEach(function (item) {
            item.addEventListener('click', function (event) {
                var id = this.getAttribute('data-id');
                var username = this.getAttribute('data-username');
                var name = this.getAttribute('data-name');
                var email = this.getAttribute('data-email');
                var is_admin = this.getAttribute('data-is_admin');
                document.getElementById('modalid').innerText = id;
                document.getElementById('modalUsername').innerText = username;
                document.getElementById('modalName').innerText = name;
                document.getElementById('modalEmail').innerText = email;
                document.getElementById('modalAdmin').innerText = is_admin;
                myModal.show();
            });
        });

        document.querySelectorAll('.delete-modal-trigger').forEach(function (item) {
            item.addEventListener('click', function (event) {
                var id = this.getAttribute('data-id');
                var username = this.getAttribute('data-username');
                document.getElementById('deleteUsersId').value = id;
                document.getElementById('modalDeleteUsername').innerText = username;
                var form = document.getElementById('deleteUsersForm');
                form.action = '{{ url("admin/users/delete") }}/' + id; // Atualiza a ação do formulário com a URL correta
                deleteModal.show();
            });
        });
    });
</script>