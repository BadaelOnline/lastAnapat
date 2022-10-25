@extends('layouts.front')

@section('content')
    <main id="main">

        <!-- ======= Services Section ======= -->
        <section id="partners" class="clients services section-bg" style="padding-top: 125px">
            <div class="container" data-aos="fade-up">

                <div class="section-title" >
                    <h2 style="text-transform: capitalize;">{{__('message.Our Partner')}}</h2>
                </div>

                <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">


                    @foreach($partners as $partner)
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="client-logo">
                                <a href="{{ route('partner',$partner->id) }}"  rel="noopener noreferrer">
                                    <img src="{{ asset('storage/'.$partner->cover) }}" class="img-fluid" alt="" style="height: 120px">
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
