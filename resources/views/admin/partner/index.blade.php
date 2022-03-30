@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Partners')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.partner.create') }}" class="btn btn-success">Create Partner</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.Numero')}}.</th>

                        <th>{{__('message.Logo')}}</th>

                        <th>{{__('message.Name')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($partner as $partner)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>

                            <img src="{{ asset('storage/'.$partner->cover) }}" alt="" style="height: 200px; width: 300px">

                        </td>

                        <td>{{ $partner->name }}</td>

                        <td>

                            <a href="{{route('admin.partner.edit', [$partner->id])}}" class="btn btn-info btn-sm"> Edit </a>

                            <form method="POST" action="{{route('admin.partner.destroy', [$partner->id])}}" class="d-inline" onsubmit="return confirm('Delete this partner permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">

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
