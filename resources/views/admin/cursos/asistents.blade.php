@extends('layouts.admin')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

    <!-- Page Heading -->

    <h1 class="h3 mb-2 text-gray-800">{{__('message.asistent')}}</h1>

    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="font-size: 14px">
                        <th>{{__('message.Número de asistente')}}</th>
                        <th>{{__('message.Apellidos')}}</th>
                        <th>{{__('message.Nombre')}}</th>
                        <th>{{__('message.Dni')}}</th>
                        <th>{{__('message.Carnet')}}</th>
                        <th>{{__('message.Nota Examen teorico')}}    </th>
                        <th>{{__('message.Nota Examen Practico')}}    </th>
                        <th>Exámen Teórico</th>
                        <th>Exámen Práctico</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $no=0;
                    @endphp
                    @foreach ($asistents as $asistent)
                        <tr>
                            <td>{{ $asistent->orden }}</td>
                            <td>{{@$asistent->operadores->nombre}}</td>
                            <td>{{@$asistent->operadores->apellidos }}</td>
                            <td>{{ @$asistent->operadores->dni }}</td>
                            <td>{{ @$asistent->operadores->carnet }}</td>
                            <td>{{ $asistent->nota_t }}</td>
                            <td>{{ $asistent->nota_p }}</td>
                            <td>
                                @if($asistent->examen_t_pdf!='')
                                    <a title="Exámen Teórico"
                                       href="{{asset('storage/' . $asistent->examen_t_pdf)}}"
                                       class="btn btn-edit btn-sm" download><i class="fa fa-download"></i></a>
                                @endif
                            </td>
                            <td>
                                @if($asistent->examen_p_pdf!='')
                                    <a title="Exámen Práctico"
                                       href="{{asset('storage/' . $asistent->examen_p_pdf)}}"
                                       class="btn btn-edit btn-sm" download><i class="fa fa-download"></i></a>
                                @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endpush
