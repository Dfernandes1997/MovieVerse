@extends('front-office.layout')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <!-- ***** Banner Start ***** -->
        <div class="main-banner">
          <div class="row">
            <div class="col-lg-7">
              <div class="header-text">
                <h6>Welcome to <strong><span style="color: #e75e8d;">Cyborg ...</span></strong> the MovieVerse</h6>
                <h4><em>Explore</em> the Cinematic Universe Here</h4>
                <div class="main-button">
                  <a href="{{ url('movies') }}">Browse Media</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Banner End ***** -->

      </div>

      <!-- ***** Popular/Ranked Start ***** -->
      <div class="page-content">

        <div class="row">
          <div class="col-lg-8">
            <div class="featured-games header-text">
              <div class="heading-section">
                <h4><em>Most Voted</em> Media</h4>
              </div>
              <div class="owl-features owl-carousel">
                @foreach ($topmovies as $movie)
                <div class="item">
                  <div class="thumb">
                    <a href="{{ route('movies.show', $movie->id) }}">
                      <img src="{{ $movie->poster }}" alt="">
                    </a>
                    <div class="hover-effect">
                      <h6>{{ number_format($movie->imdb_votes) }} Ratings</h6>
                    </div>
                  </div>
                  <a href="{{ route('movies.show', $movie->id) }}">
                    <h4>{{ $movie->title }}<br><span><strong> Released: {{ $movie->released }}</strong></span></h4>
                  </a>
                  <ul>
                    <li>IMDb : {{ $movie->imdb_rating ? $movie->imdb_rating : 'N/A' }} <i class="fa fa-star"></i></li>
                    <li>Metascore : {{ $movie->metascore ? $movie->metascore : 'N/A' }} <i class="fa fa-star"></i></li>
                  </ul>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="top-downloaded">
              <div class="heading-section">
                <h4><em>Top Ranked</em> Media</h4>
              </div>
              @foreach ($rankedmovies as $movie)
              <ul>
                <li>
                  <a href="{{ route('movies.show', $movie->id) }}">
                    <img src="{{ $movie->poster }}" alt="" class="templatemo-item">
                    <h4>{{ $movie->title }}</h4>
                    <h6>Released: {{ $movie->released }}</h6>
                  </a>
                  <span><i class="fa fa-star" style="color: yellow;"></i> IMDb : {{ $movie->imdb_rating ? $movie->imdb_rating : 'N/A' }}</span>
                  <p><span><i class="fa fa-thumbs-up" style="color: rgb(0, 162, 255);"></i> Likes : {{ $movie->likes }}</span></p>
                </li>
              </ul>
              @endforeach
            </div>
          </div>
        </div>

        <!-- ***** Suggested media start ***** -->
        <div class="live-stream">
          <div class="col-lg-12">
            <div class="heading-section">
              <h4><em>Top Picks</em> of the Day</h4>
            </div>
          </div>
          <div class="row">
            @foreach ($todaypicks as $movie)
            <div class="col-lg-3 col-sm-6">
              <div class="item">
                <div class="thumb">
                  <img src="{{ $movie->poster ? $movie->poster : asset('assets/front-section/images/default.jpg') }}" alt="">
                  <div class="hover-effect">
                    <div class="content">
                      <div class="live">
                        <a href="{{ route('movies.show', $movie->id) }}">See More</a>
                      </div>
                      <ul>
                        <li><a href=""><i class="fa fa-star"></i> {{ $movie->imdb_rating ? $movie->imdb_rating : 'N/A' }}</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i> {{ $movie->runtime ? $movie->runtime : 'N/A' }}</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="down-content">
                  <h6>{{ $movie->title }}</h6>
                  <span><i class="fa fa-calendar"></i>{{ $movie->released ? $movie->released : 'N/A'}}</span>
                </div> 
              </div>
            </div>
            @endforeach
            <div class="col-lg-12">
              <div class="main-button">
                <a href="{{ url('/movies') }}">Discover All Media</a>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Suggested Media End ***** -->
        
      </div>
      <!-- ***** Popular/ranked End ***** -->

      <div class="page-content">

        <!-- ***** Start Stream Start ***** -->
        <div class="start-stream" id="start-stream">
          <div class="col-lg-12">
            <div class="heading-section">
              <h4><em>How To Start Your</em> Media WatchList <i class="fa fa-film" aria-hidden="true"></i></h4>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="item">
                  <h4>Be a Cyborg Member <i class="fa fa-users"></i></h4>
                  <p>Join the Cyborg community by becoming a member. Enjoy exclusive benefits, access to our vast movie database, and more. If you wish to support us, you can make a <a href="https://www.paypal.com" target="_blank">small contribution via PayPal</a></p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="item">
                  <h4>Go To Your Profile <i class="fa fa-user-circle"></i></h4>
                  <p>Cyborg MovieVerse is free! Access your personalized profile where you can manage your movie preferences, update your information, and interact with other members.</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="item">
                  <h4>Save and Rate Media <i class="fa fa-bookmark"></i></h4>
                  <p>Welcome to Cyborg MovieVerse! Save your favorite movies to your profile and rate them to share your thoughts with the Cyborg community. Your ratings help others discover great films!</p>
                </div>
              </div>
              <div class="col-lg-12">
                @auth
                  <div class="main-button">
                    <a href="{{ url('profile') }}">Go To Profile</a>
                  </div>
                @else
                  <div class="main-button">
                    <a href="{{ url('register') }}">Join Cyborg</a>
                  </div>
                @endauth
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Start Stream End ***** -->

      </div>

    </div>
  </div>
</div>

@endsection