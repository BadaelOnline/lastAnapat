<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ANAPAT</title>
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
<header id="header" class="fixed-top  d-flex">
    <a href="/" class="logo ml-5">
        <img src="{{ asset('admin/img/logo-anpat.png')}}" alt="" class="img-fluid"></a>
    <div class="container d-flex align-items-center">
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li {{ request()->is('/') ? 'class=active' : '' }}><a href="{{ route('homepage') }}">{{__('message.Home')}}</a></li>
                <li class="drop-down"><a href="">{{__('message.Anapat')}}</a>
                    <ul>
                        <li ><a href="{{ route('about') }}">{{__('message.Anapat')}}</a></li>
                        <li ><a href="{{ route('about2') }}">Quienes somos</a></li>
                        <li><a href="{{ route('homepage') }}#Qué_hacemos">Tipos de PEMP</a></li>
                        <li><a href="{{ route('homepage') }}#formación">Formación</a></li>
                        <li><a href="{{ route('partners') }}">{{__('message.Partners')}}</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="">{{__('message.Formación')}}</a>
                    <ul>
                        <li ><a href="{{ route('entidades_formadoras') }}">{{__('message.Entidades Formadoras')}}</a></li>
                        <li ><a href="{{ route('cursos') }}">{{__('message.Cursos')}}</a></li>
                        <li ><a href="{{ route('carnets') }}">{{__('message.Consulta de carnet')}}</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="">{{__('message.Documentación')}}</a>
                    <ul>
                        @if(Auth::user())
                            <li class="drop-down"><a href="">{{__('message.Privado')}}</a>
                                <ul>
                                    <li ><a href="{{ route('privadoCategory',"guias") }}">{{__('message.Guías')}}</a></li>
                                    <li ><a href="{{ route('privadoCategory',"manuales") }}">{{__('message.Manuales')}}</a></li>
                                    <li ><a href="{{ route('privadoCategory',"plantillas") }}">{{__('message.Plantillas')}}</a></li>
                                </ul>

                            </li>

                        <li class="drop-down"><a href="">{{__('message.Publicos')}}</a>
                            <ul>
                                <li ><a href="{{ route('category',"guias") }}">{{__('message.Guías')}}</a></li>
                                <li ><a href="{{ route('category',"manuales") }}">{{__('message.Manuales')}}</a></li>
                                <li ><a href="{{ route('category',"plantillas") }}">{{__('message.Plantillas')}}</a></li>
                            </ul>

                        </li>
                        @else
                            <li ><a href="{{ route('category',"guias") }}">{{__('message.Guías')}}</a></li>
                            <li ><a href="{{ route('category',"manuales") }}">{{__('message.Manuales')}}</a></li>
                            <li ><a href="{{ route('category',"plantillas") }}">{{__('message.Plantillas')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li ><a href="{{ route('category',"noticias") }}">{{__('message.Noticias')}}</a></li>
                <li><a href="{{ route('contact') }}">{{__('message.Contacto')}}</a></li>
            </ul>
        </nav><!-- .nav-menu -->

        <div class="header-social-links">
            <a href="{{ route('login') }}"><i class="icofont-ui-user" style="font-size: 1.5rem"></i></a>
        </div>
       @auth()
            <a href="{{ route('login') }}" class="btn iniciar" style="margin-left: 12px;color:#0f76b0">{{auth()->user()->name}}</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary iniciar" style="margin-left: 12px">{{__('message.iniciar sesión')}}</a>
        @endauth
    </div>
</header><!-- End Header -->

@yield('content')
@include('front.cookies')
<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-links">
                    <img src="{{ asset('admin/img/logo-anpat.png')}}" alt="">
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h3>{{__('message.Company')}}</h3>
                    <ul>
                        <li>ANAPAT</li>
                        <li>   {{$general->address1}}.</li>
                        <li> {{$general->address2}}</li>
                        <li> <strong>Tel: </strong> {{$general->phone}}</li>
                        <li> <a href="">{{$general->email}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h3>{{__('message.Site Map')}}</h3>
                    <ul>
                        <li> <a href="{{ route('homepage') }}">{{__('message.Home')}}</a></li>
                        <li> <a href="{{ route('about2') }}">{{__('message.About')}}</a></li>
                        <li><a href="{{ route('contact') }}">{{__('message.Contact')}}</a></li>
                        <li> <a href="{{ route('blog') }}">{{__('message.blog')}}</a></li>
                        <li> <a href="{{ route('terms') }}">Aviso legal</a></li>
                        <li> <a href="{{ route('privacy') }}">Política de privacidad</a></li>
                        <li> <a href="{{ route('cookies') }}">Política de cookies</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h3>Enlaces de interés</h3>
                    <ul>
                        <li> <a href="{{ route('entidades_formadoras') }}">Entidades Formadoras</a></li>
                        <li> <a href="{{ route('partners') }}">{{__('message.Partner')}}</a></li>
                        <li><a href="{{ route('cursos') }}">Cursos</a></li>
                        <li> <a href="{{ route('carnets') }}">{{__('message.Card')}}</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="container d-md-flex py-4">
        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                Copyright © 2022 ANAPAT FORMACIÓN Todos los derechos reservados.
            </div>
        </div>
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


@stack('scripts')

</body>
@include('front.cookies')
</html>
