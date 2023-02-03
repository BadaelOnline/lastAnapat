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
                            {{--<p>Fecha De Alta : {{date('d/m/Y',strtotime($carnet->fecha_de_alta))}}</p>--}}
                            {{--<p>Fecha De Emision : {{date('d/m/Y',strtotime($carnet->fecha_de_emision))}}</p>--}}
                            {{--<p>Curso :--}}
                            {{--@foreach($certificado as $certific)--}}
                                    {{--{{$certific->cursoo->codigo}}       --}}
                            {{--@endforeach--}}
                            {{--</p>--}}
                            <p>Tipos de PEMP :</p>
                            <table style="margin-left: 20px">
                                <thead>
                                <th>Maquina</th>
                                <th>{{__('message.Fecha de emisión')}}</th>
                                <th>{{__('message.Fecha de vencimiento')}}</th>
                                </thead>
                                <tbody>
                                @foreach($certificado as $certific)
                                    @if($certific->tipo_1)
                                        <tr>
                                            <td>{{$certific->tipo_1}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->emision))}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->vencimiento))}}</td>
                                        </tr>
                                    @endif
                                    @if($certific->tipo_2)
                                        <tr>
                                            <td>{{$certific->tipo_2}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->emision))}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->vencimiento))}}</td>
                                        </tr>
                                    @endif
                                    @if($certific->tipo_3)
                                        <tr>
                                            <td>{{$certific->tipo_3}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->emision))}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->vencimiento))}}</td>
                                        </tr>
                                    @endif
                                    @if($certific->tipo_4)
                                        <tr>
                                            <td>{{$certific->tipo_4 }}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->emision))}}</td>
                                            <td>{{date('d/m/Y',strtotime($certific->vencimiento))}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            {{--                            <p>Examen Teorico Realizado: {{$carnet->examen_teorico_realizado}}</p>--}}
                            {{--                            <p>Estado : {{$carnet->estado == 0 ? "No" : "Si"}}</p>--}}

                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Testimonials Section -->

    </main><!-- End #main -->
@endsection
