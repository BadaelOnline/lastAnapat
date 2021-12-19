@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">Operadores</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.operadores.create') }}" class="btn btn-success">{{__('message.add_new')}} Operadores</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>



                        <th>Logo</th>

                        <th>Nombre</th>

                        <th>Apellidos </th>

                        <th>Dirección </th>

                        <th>Option</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($operadores as $operadores)

                    <tr>



                        <td>

                            <img src="{{asset('storage/' . $operadores->foto)}}" width="96px"/>

                        </td>

                        <td>{{ $operadores->nombre }}</td>

                        <td>{{ $operadores->apellidos }}</td>

                        <td>{{ $operadores->direccion  }}</td>

                        <td>

                            <a href="{{route('admin.operadores.edit', [$operadores->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.operadores.destroy', [$operadores->id])}}" class="d-inline" onsubmit="return confirm('Delete this $operadores permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-danger btn-sm">
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
