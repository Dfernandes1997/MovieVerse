@extends('back-office.layout')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 mx-auto">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit User</h6>
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Admin</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_admin" value="{{ $user->is_admin }}">
                            <input class="form-check-input" type="checkbox" id="is_admin_checkbox" {{ $user->is_admin ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_admin_checkbox"></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const is_admin_checkbox = document.getElementById('is_admin_checkbox');
    const is_admin_hidden = document.querySelector('input[name="is_admin"]');

    is_admin_checkbox.addEventListener('change', function() {
        if (this.checked) {
            is_admin_hidden.value = 1;
        } else {
            is_admin_hidden.value = 0;
        }
    });
</script>

@endsection