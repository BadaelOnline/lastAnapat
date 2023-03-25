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
              <div class="d-flex justify-content-between flex-wrap">
              <h2>{{$curso->codigo}}</h2>
              <h3>{{$curso->curso}}</h3>
            </div>
              <h3></h3>
              <hr/>
             <p>Province :{{$curso->provincia}}</p>
             <p>Ciudad :{{$curso->ciudad}} </p>
             <p>Direccion :{{$curso->direccion}}</p>
             <p>Codigo Postal :{{$curso->codigo_postal}} </p>
             <div class="d-flex align-items-center mt-3" >
               <p style="margin:0 15px 0 0">Entidad formadora :</p>
               <a >{{$entidad->nombre}}</a>
             </div>
             <p>Fecha de inicio : {{$curso->fecha_inicio}} </p>
             <p> Tipo Maquina : @foreach($tipo as $tipo)
                     {{$curso->tipo_maquina_1 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{$curso->tipo_maquina_2 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{$curso->tipo_maquina_3 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{$curso->tipo_maquina_4 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{--                {{$entidade->id}}--}}
                 @endforeach </p>

        </div>
      </div>

        </div>
      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->
@endsection
