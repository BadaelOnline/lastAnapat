@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">Cursos</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.cursos.create') }}" class="btn btn-pass">{{__('message.add_new')}}</a>

    </div>

    <div class="card-body col-md-12">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>curso</th>

                        <th>codigo</th>

                        <th>provincia</th>

                        <th>direccion</th>

                        <th>Option</th>



                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($cursos as $cursos)

                    <tr>

                        <td>{{ $cursos->curso }}</td>

                        <td>
                            {{ $cursos->codigo }}

                        </td>

                        <td>{{ $cursos->provincia }}</td>

                        <td>{{ $cursos->direccion }}</td>

                        <td>

                            <a href="{{route('admin.cursos.edit', [$cursos->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.cursos.destroy', [$cursos->id])}}" class="d-inline" onsubmit="return confirm('Delete this cursos permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                <i class='fas fa-trash-alt'></i> 
                                </button>

                            </form>
{{--                            <a href="{{route('admin.cursos.activo', [$cursos->id])}}" class="btn btn-edit btn-sm"> Activo </a>--}}



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
