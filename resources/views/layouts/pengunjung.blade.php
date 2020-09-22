<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Apartemen TamanSari</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('web/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/animate.css')}}">
    
    <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('web/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('web/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('web/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{asset('web/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">TamanSari</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item @if(request()->is('/')) {{'active'}} @endif"><a href="{{route('pengunjung.index')}}" class="nav-link">Home</a></li>
	          <li class="nav-item @if(request()->is('about')) {{'active'}} @endif"><a href="{{route('pengunjung.about')}}" class="nav-link">About</a></li>
	          <li class="nav-item @if(request()->is('services')) {{'active'}} @endif"><a href="{{route('pengunjung.services')}}" class="nav-link">Services</a></li>
	          <li class="nav-item @if(request()->is('agent')) {{'active'}} @endif"><a href="{{route('pengunjung.agent')}}" class="nav-link">Agent</a></li>
	          <li class="nav-item @if(request()->is('listing')) {{'active'}} @endif"><a href="{{route('pengunjung.listing')}}" class="nav-link">Listing</a></li>
	          <li class="nav-item @if(request()->is('blog')) {{'active'}} @endif"><a href="{{route('pengunjung.blog')}}" class="nav-link">Blog</a></li>
	          <li class="nav-item @if(request()->is('contact')) {{'active'}} @endif"><a href="{{route('pengunjung.contact')}}" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    @yield('content')		

    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Findstate</h2>
              <p>Far far away, behind the word mountains, far from the countries.</p>
              <ul class="ftco-footer-social list-unstyled mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Community</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Search Properties</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>For Agents</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Reviews</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>FAQs</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">About Us</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Our Story</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Meet the team</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Company</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About Us</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Press</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope pr-4"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
	
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with
              <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('web/js/jquery.min.js')}}"></script>
  <script src="{{asset('web/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('web/js/popper.min.js')}}"></script>
  <script src="{{asset('web/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('web/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('web/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('web/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('web/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('web/js/aos.js')}}"></script>
  <script src="{{asset('web/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('web/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('web/js/jquery.timepicker.min.js')}}"></script>
  <script src="{{asset('web/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{asset('web/js/google-map.js')}}"></script>
  <script src="{{asset('web/js/main.js')}}"></script>
    
  </body>
</html>