@extends('layouts.front')

@section('meta')
    <!-- Primary Meta Tags -->
    <meta name="description" content="{{ $general->meta_desc }}">
    <meta name="keywords" content="{{ $general->keyword }}">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="127.0.0.1:8000">
    <meta property="og:title" content="{{ $general->title }}">
    <meta property="og:description" content="{{ $general->meta_desc }}">
    <meta property="og:image" content="{{ asset('storage/'.$general->favicon) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="127.0.0.1:8000">
    <meta property="twitter:title" content="{{ $general->title }}">
    <meta property="twitter:description" content="{{ $general->meta_desc }}">
    <meta property="twitter:image" content="{{ asset('storage/'.$general->favicon) }}">

@endsection

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
                @foreach($banner as $key=>$ban)
                    <div class="carousel-item {{$key == 0 ? "active" : ""}}"
                         style="background-image: url('{{ asset('storage/'.$ban->cover) }}')">
                    <!-- <img src="{{ asset('front/img/baner1.jpg') }}" alt="" style="width: 100%;height: 100%;"> -->
                        <img src="{{ asset('storage/'.$ban->cover) }}" alt="" style="width: 100%;height: 100%;">

                    </div>
                @endforeach


            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= about us Section ======= -->
        <section id="Qué_hacemos" class="portfolio">
            <div class="container">

                <div class="section-title">
                    <h2>{{__('message.TIPOS DE PEMPAs')}}</h2>
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        @foreach($faqs as $key=>$faq)
                            <li id="{{$key}}" class="{{$key == 0 ? 'filter-active' : ''}}">{{$faq->question}}</li>
                        @endforeach
                    </ul>
                </div>
                <transition-group id="kinds" class="kinds" name="kinds">
                    @foreach($faqs as $key=>$faq)
                        <div class="item {{$key == 0 ? 'active' : ''}} animate__animated animate__backInDown"
                             id="{{$key}}">

                            <p>
                                {!! $faq->answer !!}
                            </p>

                        </div>
                    @endforeach

                </transition-group>
            </div>
        </section>
        <!-- End about us Section -->
        <!-- ======= about us Section ======= -->
        <section id="portfolio" class="portfolio about">
            <div class="container" id="formación">

                <div class="section-title">
                    <h2>{{__('message.LA FORMACIÓN DE ANAPAT. CARACTERÍSTICAS')}}</h2>
                </div>

                <div class="row">
                    <ul class="hList">
                        <li>
                            <a href="#click" class="menu">
                                <h2 class="menu-title menu-title_2nd">{{__('message.about ANAPAT')}}</h2>
                                <ul id="Inform-list" class="menu-dropdown col-md-3 col-sm-12">
                                    @foreach($pages as $key=>$page)
                                        <li class="{{$key == 0 ? 'li-active' : ''}}" id="{{$key + 1}}">{{$page->title}}</li>
                                    @endforeach
                                </ul>
                            </a>
                        </li>
                    </ul>

                    @foreach($pages as $key=>$page)
                        <div class="col-md-9 col-sm-12 info info{{$key+1}} {{$key == 0 ? 'active' : ''}} animate__animated animate__backInLeft" data-aos="fade-up">
                            <h2><span>{{$page->title}}</span></h2>
                            <p>
                                {!! $page->text !!}
                            </p>
                            <a href="{{$page->slug}}" class="btn btn-info">{{__('message.show more')}}</a>
                        </div>
                    @endforeach
                </div>


            </div>
        </section>
        <!-- End about us Section -->
        <!-- ======= Our Clients Section ======= -->
        <section id="partners" class="clients">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>{{__('message.Our Partner')}}</h2>
                </div>

                <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">


                    @foreach($partner as $partner)
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="client-logo">
                                <a href="{{ route('partner',$partner->id) }}" rel="noopener noreferrer">
                                    <img src="{{ asset('storage/'.$partner->cover) }}" class="img-fluid" alt=""
                                         style="height: 120px">
                                    {{--                                    <h2 style="text-align: center;"> {{$partner->name}}</h2>--}}
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section><!-- End Our Clients Section -->

    </main><!-- End #main -->
@endsection
