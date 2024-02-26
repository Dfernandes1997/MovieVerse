@extends('front-office.layout')

@section('content')


<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <!-- ***** Banner Start ***** -->
        <div class="row">
          <div class="col-lg-12">
            <div class="main-profile ">
              <div class="row">
                <div class="col-lg-4">
                  <img src="{{asset('assets/front-section/images/profile-header.jpg')}}" alt="" style="border-radius: 23px;">
                </div>
                <div class="col-lg-4 align-self-center">
                  <div class="main-info header-text">
                    <span>Online</span>
                    <h4>{{ auth()->user()->name }}</h4>
                    <p>This is your profile, update your information. See your activity.</p>
                    <div class="main-border-button">
                      <a href="{{ url('favorites') }}">My Watchlist</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 align-self-center">
                  <ul>
                    <li>Number of Watchlist <span>{{ $watchlistCount }}</span></li>
                    <li>Comments <span>{{ $comments }}</span></li>
                    <li>Likes in other comments <span>{{ $commentlikes }}</span></li>
                    <li>Media Likes <span>{{ $medialikes }}</span></li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="clips">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="feature-banner header-text mt-3">
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="heading-section d-flex justify-content-between align-items-center mb-3">
                                    <h4><em>Media</em> Likes <i class="fa fa-thumbs-up"></i></h4>
                                </div>
                                <div class="col-lg-10 mb-5">
                                    <div class="item" style=" padding: 20px; border: 1px solid #444; border-radius: 23px;">
                                      <h4 class="mb-2">Your favorites:</h4>
                                      @foreach($likes as $like)
                                        <p>- {{ $like->multimedia->title }}</p>
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="heading-section d-flex justify-content-between align-items-center mb-3">
                                    <h4><em>Update</em> Details <i class="fa fa-user-circle"></i></h4>
                                </div>
                                <form id="updateForm" method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group mb-5">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required
                                            @auth
                                                value="{{ auth()->user()->name }}"
                                            @endauth
                                        >
                                    </div>
                                    <div class="col-md-6 form-group mb-5">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" required
                                            @auth
                                                value="{{ auth()->user()->username }}"
                                            @endauth
                                        >
                                    </div>
                                    <div class="col-md-12 form-group mb-5">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required
                                          @auth
                                            value="{{ auth()->user()->email }}"
                                          @endauth
                                        >
                                    </div>
                                    <div class="mb-3" style="color: white; font-weight: bold;">
                                      By clicking the Update button, you consent to the changes in your information and agree to our <span style="color: #e75e8d;">Terms and Conditions</span> and <span style="color: #e75e8d;">Privacy Policy</span>.
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Update</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Banner End ***** -->

      </div>
    </div>
  </div>
</div>

@endsection