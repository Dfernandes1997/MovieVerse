@extends('front-office.layout')

@section('content')

{{-- Conteudo da pagina  --}}

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <!-- ***** Featured Start ***** -->
        <div class="row">
          <div class="col-lg-12">
            <div class="feature-banner header-text">
              <div class="row">
                <div class="col-lg-6">
                    <div class="heading-section d-flex justify-content-between align-items-center mb-3">
                        <h4><em>More</em> Info <i class="fa fa-info-circle"></i></h4>
                    </div>
                    <div class="col-lg-10 mb-5">
                        <div class="item" style=" padding: 30px; border: 1px solid #444; border-radius: 23px;">
                          <h4 class="mb-2">Support by phone</h4>
                          <p>+351 21 75 24 524 from 7:00 am to 10:00 pm (call to national landline network).</p>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="item" style=" padding: 30px; border: 1px solid #444; border-radius: 23px;">
                          <h4 class="mb-2">App Support</h4>
                          <p>Download our app from the app store to enjoy Cyborg MovieVerse on the go and access more helpful support.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading-section d-flex justify-content-between align-items-center mb-3">
                        <h4><em>Contact</em> Support <i class="fa fa-envelope"></i></h4>
                    </div>
                    <form id="contactForm" method="POST" action="{{ route('contact.save') }}">
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
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required
                                @auth
                                    value="{{ auth()->user()->email }}"
                                @endauth
                            >
                        </div>
                        <div class="col-md-12 form-group mb-5">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <div class="mb-3" style="color: white; font-weight: bold;">
                            By clicking Send, you consent that you have read and agree to our <span style="color: #e75e8d;">Terms and Conditions</span> and <span span style="color: #e75e8d;">Privacy Policy</span>.
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn" style="background-color: #ec6090; color: white;">Send</button>
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

@endsection