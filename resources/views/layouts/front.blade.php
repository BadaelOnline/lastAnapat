<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    @yield('title')
    {{ $general->title }}</title>
  <meta content="{{ $general->meta_desc }}" name="description">
  <meta content="{{ $general->keyword }}" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('storage/'.$general->favicon) }}" rel="icon">
  <link href="{{ asset('storage/'.$general->favicon) }}" rel="apple-touch-icon">

  @yield('meta')
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <!-- <link href="{{ asset('front/css/style.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('front/css/style-anapat.css') }}" rel="stylesheet">
  
  {{-- Sharethis --}}
  {!! $general->sharethis !!}

  <!-- =======================================================
  * Template Name: Company - v2.1.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="/" class="logo ">
        <img src="{{ asset('admin/img/logo-anpat.png')}}" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li {{ request()->is('/') ? 'class=active' : '' }}><a href="{{ route('homepage') }}">Home</a></li>

          <li class="drop-down"><a href="">Anapat</a>
            <ul>
              <li ><a href="{{ route('about') }}">Anapat</a></li>
              <li><a href="{{ route('testi') }}">Partner</a></li>
            </ul>
          </li>
          <li class="drop-down"><a href="">Training</a>
            <ul>
              <li ><a href="{{ route('about') }}">Training Entity</a></li>
              <li ><a href="{{ route('testi') }}">Courses</a></li>
              <li ><a href="{{ route('testi') }}">Card Consultation</a></li>
            </ul>
          </li>
          <li class="drop-down"><a href="">Documentation</a>
            <ul>
              <li class="drop-down"><a href="">Didactics</a>
            <ul>
              <li ><a href="{{ route('about') }}">Guides</a></li>
              <li ><a href="{{ route('testi') }}">Manuals</a></li>
            </ul>
        
              </a></li>
              <li class="drop-down"><a href="">Forms</a>
            <ul>
              <li ><a href="{{ route('about') }}">Inscription</a></li>
              <li ><a href="{{ route('testi') }}">Come down </a></li>
            </ul>
         
              </a></li>
              <li ><a href="{{ route('testi') }}">Others</a></li>
            </ul>
          </li>
          <li ><a href="">News</a></li>
          <li><a href="">Contact</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <a href=""><i class="icofont-ui-user"></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
          <h3>Company</h3>
            <ul>
              <li> ANAPAT</li>
              <li>   C / Albasanz, 67– 2º – Office 47.</li>
              <li>     28037 Madrid</li>
              <li> 28037 Madrid</li>
              <li> <strong>Tel:</strong> 91 375 81 22</li>
              <li> <strong>FAX:</strong> 91 327 23 55</li>
              <li> <a href="">secretario@anapat.es</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h3>Site Map</h3>
            <ul>
              <li> <a href="">Home</a></li>
              <li> <a href="">About</a></li>
              <li><a href="">Contact</a></li>
              <li> <a href="">blog</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h3>useful link</h3>
            <ul>
              <li> <a href="">Training Entity</a></li>
              <li> <a href="">Partner</a></li>
              <li><a href="">Course</a></li>
              <li> <a href="">Card</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
         <img src="{{ asset('admin/img/logo-anpat.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="container d-md-flex py-4">
      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
        Copyright © 2021 anapat | Powered by anapat
        </div>
      </div>
      <!-- <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="{{ $general->twitter }}" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="{{ $general->facebook }}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="{{ $general->instagram }}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="{{ $general->linkedin }}" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('front/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('front/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
  <script src="{{ asset('front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('front/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('front/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('front/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('front/js/main.js') }}"></script>

  {!! $general->tawkto !!}

  @stack('scripts')

</body>

</html>
