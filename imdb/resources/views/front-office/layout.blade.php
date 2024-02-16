<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Cyborg - The MovieVerse</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/front-section/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Additional CSS Files -->
    {{-- <link rel="stylesheet" href="{{asset('assets/front-section/css/fontawesome.css')}}" /> --}}
    <script src="https://kit.fontawesome.com/b3779d2a08.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/front-section/css/templatemo-cyborg-gaming.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front-section/css/owl.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front-section/css/animate.css')}}" />
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{asset('assets/front-section/images/logo.png')}}" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="{{ url('movies') }}" class="{{ request()->is('movies') ? 'active' : '' }}"><i class="fa fa-film"></i> Media</a></li>
                        <li>
                          @auth
                              <a href="{{ url('favorites') }}"><i class="fa fa-bookmark"></i> WatchList </a>
                          @else
                              <a href="{{ url('/no-account') }}"><i class="fa fa-bookmark"></i> WatchList </a>
                          @endauth
                        </li>
                        @auth
                            @if(auth()->user()->is_admin == 1)
                                <li><a href="{{ url('admin') }}"><i class="fa fa-user-circle"></i> Admin</a></li>
                            @endif
                            <li>
                                <form id="logoutForm" method="POST" action="/logout">
                                    @csrf
                                    <a href="#" onclick="document.getElementById('logoutForm').submit();"><i class="fa fa-sign-out"></i> Log out</a>
                                </form>
                            </li>
                            <li><a href="profile.html">{{ auth()->user()->username }}<img src="{{asset('assets/front-section/images/profile-header.jpg')}}" alt=""></a></li>
                        @else
                            <li><a href="{{ url('login') }}"><i class="fa fa-sign-in"></i> Log in</a></li>
                        @endauth
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  
    <div>
        @yield('content')
    </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2036 <a href="#">Cyborg Movies</a> Company. All rights reserved. 
          
          <br>Design: <a href="https://github.com/Dfernandes1997" target="_blank" title="free CSS templates">Diogo Fernandes</a>  Distributed By <a href="https://www.claranet.com/" target="_blank" >Claranet</a></p>
        </div>
      </div>
    </div>
    <!-- Messages -->
    @include('front-office.components.flash')
  </footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('assets/front-section/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/front-section/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{asset('assets/front-section/js/isotope.min.js')}}"></script>
  <script src="{{asset('assets/front-section/js/owl-carousel.js')}}"></script>
  <script src="{{asset('assets/front-section/js/tabs.js')}}"></script>
  <script src="{{asset('assets/front-section/js/popup.js')}}"></script>
  <script src="{{asset('assets/front-section/js/custom.js')}}"></script>  {{-- aqui esta a função showWatchListMessage() --}}

  {{-- Alpine biblioteca para messages --}}
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


  </body>

</html>