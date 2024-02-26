@extends('back-office.layout')

@section('content')


    @if(!($multimedia || $person || $genre || $type || $user || $contact))
        <!-- Information start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Users</p>
                            <h6 class="mb-0">{{ $totalUsers }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-thumbs-up fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Likes in Media</p>
                            <h6 class="mb-0">{{ $totalLikedMedia }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-comments fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Comments</p>
                            <h6 class="mb-0">{{ $totalComments }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-video-camera fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Media</p>
                            <h6 class="mb-0">{{ $totalMedia }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Information End -->

        <!-- Charts estão no public/assets/admin-section/js/main.js -->

        <!-- Chart Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Users With Most Comments</h6>
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Most Genres</h6>
                        <canvas id="bar-chart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Top Liked Media</h6>
                        <canvas id="pie-chart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Top Voted Media</h6>
                        <canvas id="doughnut-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chart End -->

        <script>
            var totalMoviesByGenre = {!! json_encode($totalMoviesByGenre) !!};
            var multimedia5likes = {!! json_encode($multimedia5likes) !!};
            var multimedia5Votes = {!! json_encode($multimedia5Votes) !!};
            var usersWithMostComments = {!! json_encode($usersWithMostComments) !!};
        </script>
        <script src="{{asset('assets/admin-section/js/main.js')}}"></script>
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

    @if($contact)
        @include('back-office.contacts.components.table')
    @endif
@endsection