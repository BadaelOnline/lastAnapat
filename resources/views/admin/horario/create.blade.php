@extends('layouts.admin')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.horario.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="form-group ml-2">
                <label for="curso" class="col-sm-2 col-form-label">Curso</label>
                <div class="col-sm-9">
                    <select name='test' disabled class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " id="curso">
                        @foreach ($curso as $curso)
                            <option value="{{ $curso->id }}" {{$id == $curso->id ? "selected" : ""}}>{{ $curso->curso }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="curso" value="{{$id}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('curso') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-group ml-2">
                <label for="category" class="col-sm-2 col-form-label">Contenido</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contenido" value="1" id=1>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Teoria
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contenido" value="2" id=2 checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Practica
                    </label>
                </div>
            </div>
        </div>



        <div class="container">
            <div class="form-group ml-2">
                <label for="title" class="col-sm-2 col-form-label">Alumnos</label>
                <div class="col-sm-10">
                    <input type="text" name='alumnos' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('alumnos')}}" id="alumnos" placeholder="Número de asistentes

">
                    <div class="invalid-feedback">
                        {{ $errors->first('alumnos') }}
                    </div>
                </div>
            </div>

            <label for="date" class="col-sm-2 col-form-label">Fecha Inicio</label>
            <div class="col-sm-9">
                <input type="datetime-local" name='fecha_inicio' class="form-control {{$errors->first('fecha_inicio') ? "is-invalid" : "" }} " value="{{old('fecha_inicio')}}" id="fecha_inicio" >
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_inicio') }}
                </div>
            </div>
            <label for="date" class="col-sm-2 col-form-label">	final</label>
            <div class="col-sm-9">
                <input type="datetime-local" name='final' class="form-control {{$errors->first('final') ? "is-invalid" : "" }} " value="{{old('final')}}" id="final" >
                <div class="invalid-feedback">
                    {{ $errors->first('	final') }}
                </div>
            </div>

            <div class="form-group ml-2">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">{{__('message.Create')}}</button>
                </div>
            </div>
        </div>

    </form>
@endsection
