@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Carnets')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">


{{--        <a href="{{ route('admin.carnet.choseOperador') }}" class="btn btn-pass">{{__('message.add_new')}} carnet</a>--}}


    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.numero')}}</th>

                        <th>{{__('message.Operador')}}</th>

                        <th>{{__('message.Fecha De Emisión')}} </th>

                        <th>{{__('message.Fecha De Vencimiento')}} </th>

                        <th>{{__('message.foto')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($carnets as $carnets)

                    <tr>
                        <td>{{ $carnets->numero }}</td>
                        <td>{{ $carnets->operadores->nombre }} {{$carnets->operadores->apellidos}}</td>
                        <td>{{ date('d/m/Y',strtotime($carnets->fecha_de_emision))  }}</td>
                        <td> {{ date('d/m/Y',strtotime($carnets->fecha_de_alta)) }} </td>

                        <td>
                            <img src="{{asset('storage/' . $carnets->operadores->foto)}}" width="96px"/>
                        </td>
                        <td>
{{--                        <a href="{{route('admin.carnet.edit', [$carnets->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>--}}


                            <form method="POST" action="{{route('admin.carnet.destroy', [$carnets->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete permanently?")}}')">

                                @csrf
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                <i class='fas fa-trash-alt'></i>
                                </button>
                            </form>
                        </td>
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
