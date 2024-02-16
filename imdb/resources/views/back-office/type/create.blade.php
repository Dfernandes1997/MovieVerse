@extends('back-office.layout')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 mx-auto">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="card-header">Create Type</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.types.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

