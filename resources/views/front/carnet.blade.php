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
                                <img class="image" src="{{asset('storage/' . $operador->foto)}}" alt="" width="120px">
                                {{--<img class="image" src="{{asset('storage/' . $operador->dni_img)}}" alt=""></div>--}}
                            </div>
                            <h2 class="align-content-center" style="text-align: center;">{{$carnet->numero}}</h2>
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <img class="image" src="{{asset('storage/' . $carnet->foto)}}" alt=""--}}
{{--                                     style="margin-left: 10px;">--}}

{{--                            </div>--}}
                            <hr/>
                            <p>Operador : {{$operador->nombre}} {{$operador->apellidos}}</p>
                            <p>Fecha De Alta : {{$carnet->fecha_de_alta}}</p>
                            <p>Fecha De Emision : {{$carnet->fecha_de_emision}}</p>
                            <p>Tipos De Pemp :</p>
                            <table class="table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($carnet->Tipo_Maquinas as $t)
                                <tr>

                                        <td>{{$t->tipo_maquina}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <p>Curso : {{$curso->codigo}}</p>
                            {{--                            <p>Examen Teorico Realizado: {{$carnet->examen_teorico_realizado}}</p>--}}
                            {{--                            <p>Estado : {{$carnet->estado == 0 ? "No" : "Si"}}</p>--}}

                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Testimonials Section -->

    </main><!-- End #main -->
@endsection
