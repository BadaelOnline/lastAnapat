@extends('layouts.admin')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

    <!-- Page Heading -->

    <h1 class="h3 mb-2 text-gray-800">Entidades Formadoreas</h1>

    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>
    @endif

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        @can('isHaveEntitade')
            <div class="card-header py-3">
                <a href="{{ route('admin.entidades_formadoreas.create') }}" class="btn btn-pass">{{__('message.add_new')}} Entidades Formadores</a>
            </div>
        @endcan

        <div class="card-body">

            <div class="table-responsive">

                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>CIF.</th>
                        <th>Nombre</th>

                        <th>Dirección </th>

                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php

                        $no=0;

                    @endphp

                    @foreach ($entidadesFormadores as $entidadesFormadores)

                        <tr>
                            <td>

                                <img src="{{asset('storage/' . $entidadesFormadores->logo)}}" width="96px"/>
                            </td>
                            <td>{{ $entidadesFormadores->cif }}</td>
                            <td>{{ $entidadesFormadores->nombre }}</td>
                            <td>{{ $entidadesFormadores->direccion  }}</td>
                            <td>
                                <a href="{{route('admin.entidades_formadoreas.edit', [$entidadesFormadores->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>
                                <form method="POST" action="{{route('admin.entidades_formadoreas.destroy', [$entidadesFormadores->id])}}" class="d-inline" onsubmit="return confirm('Delete this $entidadesFormadores permanently?')">
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
