@extends('back-office.layout')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 mx-auto">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="card-header">Create Multimedia</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.multimedia.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}">
                        </div>
                        <div class="mb-3">
                            <label for="released" class="form-label">Released</label>
                            <input type="text" class="form-control" id="released" name="released" value="{{ old('released') }}">
                        </div>
                        <div class="mb-3">
                            <label for="runtime" class="form-label">Run Time</label>
                            <input type="text" class="form-control" id="runtime" name="runtime" value="{{ old('runtime') }}">
                        </div>
                        <div class="mb-3">
                            <label for="plot" class="form-label">Plot</label>
                            <textarea class="form-control" id="plot" name="plot">{{ old('plot') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="language" class="form-label">Language</label>
                            <input type="text" class="form-control" id="language" name="language" value="{{ old('language') }}">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                        </div>
                        <div class="mb-3">
                            <label for="awards" class="form-label">Awards</label>
                            <input type="text" class="form-control" id="awards" name="awards" value="{{ old('awards') }}">
                        </div>
                        <div class="mb-3">
                            <label for="box_office" class="form-label">Box Office</label>
                            <input type="text" class="form-control" id="box_office" name="box_office" value="{{ old('box_office') }}">
                        </div>
                        <div class="mb-3">
                            <label for="type_id" class="form-label">Type</label>
                            <select class="form-select mb-3" id="type_id" name="type_id" aria-label="Default select example">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="metascore" class="form-label">Metascore</label>
                            <input type="text" class="form-control" id="metascore" name="metascore" value="{{ old('metascore') }}">
                        </div>
                        <div class="mb-3">
                            <label for="imdb_rating" class="form-label">IMDb Rating</label>
                            <input type="text" class="form-control" id="imdb_rating" name="imdb_rating" value="{{ old('imdb_rating') }}">
                        </div>
                        <div class="mb-3">
                            <label for="imdb_votes" class="form-label">IMDb Votes</label>
                            <input type="text" class="form-control" id="imdb_votes" name="imdb_votes" value="{{ old('imdb_votes') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

