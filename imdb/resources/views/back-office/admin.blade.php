@extends('back-office.layout')

@section('content')


    @if(!($multimedia || $person || $genre || $type || $user))
        <!-- Welcom Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3>Welcome Back, {{ auth()->user()->name }}</h3>
                </div>
            </div>
        </div>
        <!-- Welcome End -->
    @endif

    @if($multimedia)
        @include('back-office.multimedia.components.table')
    @endif

    @if($person)
        @include('back-office.person.components.table')
    @endif

    @if($genre)
        @include('back-office.genre.components.table')
    @endif

    @if($type)
        @include('back-office.type.components.table')
    @endif

    @if($user)
        @include('back-office.user.components.table')
    @endif

@endsection