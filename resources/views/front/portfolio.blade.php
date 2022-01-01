@extends('layouts.front')

@section('content')
<main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">
      <h2 class="title" style="margin-top: 50px;">Courses</h2>
        <div class="row">
          @foreach ($service as $service)
          <div class="col-lg-3 col-md-6 d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box icon-box2">
            <div class="imag">
              <img src="{{ asset('front/img/haulotte.png')}}" alt="">
            </div>
            <h4><a href="{{ route('serviceshow',$service->slug) }}">2100001</a></h4>
            <p>, RENTAIRE MACHINERY RENTAL</p>
           <a href="{{ route('serviceshow',$service->slug) }}"> <button>Details</button></a>
          </div>
        </div>
        @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->
@endsection