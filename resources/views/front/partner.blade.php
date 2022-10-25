@extends('layouts.front')

@section('content')
    <main id="main">

        <!-- ======= Testimonials Section ======= -->
        <section class="courses">
            <div class="container">
                <h2 class="title" style="margin: 50px 0;"></h2>
                <div class="row">

                    <div class="d-flex justify-content-center contain-card">
                        <div class="card">


                            <div class="d-flex align-items-center">

                                <img class="image" src="{{asset('storage/' . $partner->cover)}}" alt=""></div>
                            <hr/>
                            <br>
                            <a  class="align-self-lg-center" href="{{$partner->link}}" ><h2  class="align-self-lg-center">{{$partner->name}}</h2></a>
{{--                            <p>Web: <a href="{{$partner->link}}" > {{$partner->link}}</a></p>--}}

                            <p>{{__('message.empresa')}} : {{$partner->empresa}}</p>
                            <p>{{__('message.direccion')}} : {{$partner->direccion}}</p>
                            <p>{{__('message.codigo_postal')}} : {{$partner->codigo_postal}}</p>
                            <p>{{__('message.poblacion')}} : {{$partner->poblacion}}</p>
                            <p>{{__('message.Provincia')}} : {{$partner->provincia}}</p>
                            <p>{{__('message.telefono')}} : {{$partner->telefono}}</p>
                            <p>{{__('message.Email')}} : {{$partner->email}}</p>
                            {{--<p>{{__('message.Email')}} : {{$partner->email}}</p>--}}
                            <p>{{__('message.web')}} : {{$partner->link}}</p>
                            {{--              <div class="d-flex justify-content-center">--}}
                            {{--              <a href="">Show Assistants</a>--}}
                            {{--              <span class="ml-3 mr-3">or</span>--}}
                            {{--              <a href="">Download</a>--}}
                            {{--              </div>--}}
{{--                            <p></p>--}}
                            <a  class="align-self-lg-center" href="{{$partner->link}}" ><p  class="align-self-lg-center">Novedades y Ofertas</p></a>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Testimonials Section -->

    </main><!-- End #main -->
@endsection
