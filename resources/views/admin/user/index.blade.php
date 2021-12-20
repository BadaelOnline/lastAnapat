@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">
{{--@can('isAdminOrResponsable')--}}
{{--    <div class="card-header py-3">--}}
{{--        <a href="{{ route('admin.user.create') }}" class="btn btn-pass">{{__('message.add_new')}}</a>--}}
{{--    </div>--}}
{{--@endcan--}}
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>

                        <th>Nombre</th>

                        <th>Email</th>

                        <th>Perfil</th>

                        <th>Option</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($user as $user)
                @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$user->entidad)
                || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$user->entidad&& $user->perfil='Formador'))
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->perfil }}</td>
                        <td>
                            @if(auth()->user()->id==$user->id || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$user->entidad && $user->perfil='Formador'))
                            <a href="#" data-toggle="modal" data-target="#changepasswordModal" class="btn btn-pass btn-sm">Change Password</a>
                            <a href="{{route('admin.user.edit', [$user->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.user.destroy', [$user->id])}}" class="d-inline" onsubmit="return confirm('Delete this user permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                <i class='fas fa-trash-alt'></i> 
                                </button>

                            </form>
                            @endif
                        </td>

                    </tr>
                    @endif
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- Change password Modal-->
<div class="modal fade" id="changepasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{ route('admin.user.changepassword',$user->id) }}" method="POST">
            @csrf
        <div class="modal-body">

            <input type="password" name='password' class="form-control {{$errors->first('password') ? "is-invalid" : "" }} " id="password" placeholder="New Password">

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <button type="submit" class="btn btn-primary">Update</button>

        </div>
    </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
