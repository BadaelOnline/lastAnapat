@extends('layouts.admin')
@section('styles')
<style>
input[type="radio"] {
    cursor: pointer;
}
input[type="radio"]:focus {
    color: #495057;
    background-color: #0477b1;
    border-color: transparent;
    outline: 0;
    box-shadow: none;
}
</style>

@endsection
@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.formadores.update',$formadores->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="codigo" class="col-sm-2 col-form-label">Codigo</label>

                <div class="col-sm-9">
                    <input type="text" name='codigo' class="form-control {{$errors->first('codigo') ? "is-invalid" : "" }} " value="{{old('codigo') ? old('codigo') : $formadores->codigo}}" id="codigo" placeholder="Código del Formador
Name">
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo') }}
                    </div>
                </div>
            </div>

            {{--<div class="form-group col-md-4">--}}
            {{--<label for="quote" class="col-sm-2 col-form-label">Entidad</label>--}}
            {{--<div class="col-sm-9">--}}
            {{--<input type="text" name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} " value="{{old('entidad')}}" id="entidad" placeholder="entidad">--}}
            {{--<div class="invalid-feedback">--}}
            {{--{{ $errors->first('entidad') }}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="form-group col-md-4">
                <label for="entidad" class="col-sm-2 col-form-label">Entidad </label>
                <div class="col-sm-9">
                    <select name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} " id="entidad">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($entidad as $entidad)
                            <option value="{{ $entidad->id }}" {{$formadores->entidad == $entidad->id ? "selected" : ""}}>{{ $entidad->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('entidad') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="apellidos" class="col-sm-2 col-form-label">Apellidos </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" placeholder="Apellidos del Formador Name" name="apellidos" id="apellidos" cols="40" rows="10"  class="form-control {{$errors->first('apellidos') ? "is-invalid" : "" }} " value="{{old('apellidos') ? old('apellidos') : $formadores->apellidos}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('apellidos') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" name="nombre" placeholder="Nombre del formador" id="nombre"   class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre') ? old('nombre') : $formadores->nombre}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni" class="col-sm-2 col-form-label">DNI </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" placeholder="Documento identificación" name="dni" id="dni" cols="40" rows="10"  class="form-control {{$errors->first('dni') ? "is-invalid" : "" }} " value="{{old('dni') ? old('dni') : $formadores->dni}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('dni') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni_img" class="col-sm-2 col-form-label">DNI </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="dni_img" id="dni_img" cols="40" rows="10"  class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} " value="{{old('dni_img') ? old('dni_img') : $formadores->dni_img}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('dni_img') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="operador_pdf" class="col-sm-2 col-form-label">Operador PDF</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="operador_pdf" id="operador_pdf" cols="40" rows="10"  class="form-control {{$errors->first('operador_pdf') ? "is-invalid" : "" }} " value="{{old('operador_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('operador_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="cert_empresa_pdf" class="col-sm-2 col-form-label">Cert Empresa PDF</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="cert_empresa_pdf" id="cert_empresa_pdf"   class="form-control {{$errors->first('cert_empresa_pdf	') ? "is-invalid" : "" }} " value="{{old('cert_empresa_pdf	')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('cert_empresa_pdf	') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="vida_laboral_pdf" class="col-sm-2 col-form-label">Vida laboral pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="vida_laboral_pdf" id="vida_laboral_pdf" cols="40" rows="10"  class="form-control {{$errors->first('vida_laboral_pdf') ? "is-invalid" : "" }} " value="{{old('vida_laboral_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('vida_laboral_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="prl_pdf" class="col-sm-2 col-form-label">PRL PDF</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="prl_pdf" id="prl_pdf" cols="40" rows="10"  class="form-control {{$errors->first('prl_pdf') ? "is-invalid" : "" }} " value="{{old('prl_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('prl_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="pemp_pdf" class="col-sm-2 col-form-label">PEMP PDF</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="pemp_pdf" id="pemp_pdf" cols="40" rows="10"  class="form-control {{$errors->first('pemp_pdf') ? "is-invalid" : "" }} " value="{{old('pemp_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('pemp_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="cap_pdf" class="col-sm-2 col-form-label">CAP PDF</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="cap_pdf" id="cap_pdf" cols="40" rows="10"  class="form-control {{$errors->first('cap_pdf') ? "is-invalid" : "" }} " value="{{old('cap_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('cap_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="fecha" class="col-sm-2 col-form-label">	Fecha</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="fecha" id="fecha" cols="40" rows="10"  class="form-control {{$errors->first('fecha') ? "is-invalid" : "" }} " value="{{old('fecha') ? old('fecha') : $formadores->fecha}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex flex-column justify-content-center">
                <label for="estado" class="col-sm-12 col-form-label text-center">Estado</label>
                <label class="switch">
                    <input type="checkbox" name="estado" {{$formadores->estado == 1 ? "checked" : ""}}>
                    <span class="slider round" ></span>
                </label>
            </div>

            <div class="form-group col-md-12">

                <div class="col-sm-3">

                    <button type="submit" class="btn btn-info">{{__('message.Update')}}</button>

                </div>

            </div>

        </div>

    </form>
@endsection
