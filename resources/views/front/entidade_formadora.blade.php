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

              <h2>{{$entidadesFormadore->nombre}}</h2>
              <div class="d-flex align-items-center">
                </h3>
                <img class="image" src="{{asset('storage/' . $entidadesFormadore->logo)}}" alt=""></div>
              <hr/>
             <p>Provincia  : {{$entidadesFormadore->province}}</p>
             <p>Ciudad  : {{$entidadesFormadore->ciudad}} </p>
             <p>Dirección : {{$entidadesFormadore->direccion}}</p>
{{--             <p>CIF : {{$entidadesFormadore->cif}}</p>--}}
             <p>Razón social : {{$entidadesFormadore->razon_social}}</p>
             <p>Código postal : {{$entidadesFormadore->codigo_postal}}</p>
            <p>{{__('message.WEB')}}: <a href="{{$entidadesFormadore->web}}" > {{$entidadesFormadore->web}}</a></p>
             <p>{{__('message.Mail')}} : <a href="mailto:{{$entidadesFormadore->mail}}" > {{$entidadesFormadore->mail}}</a></p>
             <p>Certificada : {{$entidadesFormadore->certificado == 0 ? "En Proceso de Certificación" : "Si"}}</p>
              <p></p>
{{--              <div class="d-flex justify-content-center">--}}
{{--              <a href="">Show Assistants</a>--}}
{{--              <span class="ml-3 mr-3">or</span>--}}
{{--              <a href="">Download</a>--}}
{{--              </div>--}}
              <p></p>
              <button><a href="{{$entidadesFormadore->web}}" style="color: #000000;"> {{__('message.WEB')}}</a></button>
        </div>
      </div>

        </div>
      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->
@endsection
