@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">Formadores</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">
        @if(auth()->user()->perfil=='Administrador')
          <a href="{{ route('admin.formadores.create') }}" class="btn btn-pass">{{__('message.add_new')}} Formadores</a>
        @endif


    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.Codigo')}}</th>

                        <th>{{__('message.Nombre')}} </th>

                        <th>{{__('message.Apellidos')}} </th>

                        <th>{{__('message.DNI')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($formadores as $formadores)
                    @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$formadores->entidad)
                        || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$formadores->entidad))
                    <tr>
                        <td>{{ $formadores->codigo }}</td>
                        <td> {{ $formadores->nombre }} </td>
                        <td>{{ $formadores->apellidos }}</td>
                        <td>
                            <img src="{{asset('storage/' . $formadores->dni_img)}}" width="96px"/>
                        </td>
                        <td>
                        <a href="{{route('admin.formadores.edit', [$formadores->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>


                            <form method="POST" action="{{route('admin.formadores.destroy', [$formadores->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete permanently?")}}')">

                                @csrf
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                <i class='fas fa-trash-alt'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                        @endif
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
