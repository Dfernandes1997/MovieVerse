@extends('back-office.layout')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 mx-auto">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Multimedia</h6>
                <form method="POST" action="{{ route('admin.multimedia.update', $multimedia->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $multimedia->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" value="{{ $multimedia->year }}">
                    </div>
                    <div class="mb-3">
                        <label for="released" class="form-label">Released</label>
                        <input type="text" class="form-control" id="released" name="released" value="{{ $multimedia->released }}">
                    </div>
                    <div class="mb-3">
                        <label for="runtime" class="form-label">Run Time</label>
                        <input type="text" class="form-control" id="runtime" name="runtime" value="{{ $multimedia->runtime }}">
                    </div>
                    <div class="mb-3">
                        <label for="plot" class="form-label">Plot</label>
                        <textarea class="form-control" id="plot" name="plot">{{ $multimedia->plot }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="language" class="form-label">Language</label>
                        <input type="text" class="form-control" id="language" name="language" value="{{ $multimedia->language }}">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ $multimedia->country }}">
                    </div>
                    <div class="mb-3">
                        <label for="awards" class="form-label">Awards</label>
                        <input type="text" class="form-control" id="awards" name="awards" value="{{ $multimedia->awards }}">
                    </div>
                    <div class="mb-3">
                        <label for="box_office" class="form-label">Box Office</label>
                        <input type="text" class="form-control" id="box_office" name="box_office" value="{{ $multimedia->box_office }}">
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type ID</label>
                        <input type="text" class="form-control" id="type_id" name="type_id" value="{{ $multimedia->type_id }}">
                    </div>
                    <div class="mb-3">
                        <label for="metascore" class="form-label">Metascore</label>
                        <input type="text" class="form-control" id="metascore" name="metascore" value="{{ $multimedia->metascore }}">
                    </div>
                    <div class="mb-3">
                        <label for="imdb_rating" class="form-label">IMDb Rating</label>
                        <input type="text" class="form-control" id="imdb_rating" name="imdb_rating" value="{{ $multimedia->imdb_rating }}">
                    </div>
                    <div class="mb-3">
                        <label for="imdb_votes" class="form-label">IMDb Votes</label>
                        <input type="text" class="form-control" id="imdb_votes" name="imdb_votes" value="{{ $multimedia->imdb_votes }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection