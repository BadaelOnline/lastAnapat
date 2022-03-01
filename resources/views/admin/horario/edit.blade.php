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

    <form action="{{ route('admin.horario.update',$horario->id) }}" method="POST">
        @csrf
        <div class="form-groups">
            <div class="form-group col-md-4">
                <label for="curso" class="col-sm-2 col-form-label">Curso</label>
                <div class="col-sm-9">
                    <select name='curso' class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " id="curso">
{{--                        <option value="{{ $horario->curso }}">{{ $curso->curso }}</option>--}}
                        @foreach ($curso as $curso)
                            <option value="{{ $curso->id }}" {{$horario->curso == $curso->id ? "selected" : ""}}>{{ $curso->curso }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('curso') }}
                    </div>
                </div>
            </div>


            <div class="form-group col-md-4">
                <label for="contenido" class="col-sm-2 col-form-label">Contenido</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" {{$horario->contenido == "Teoría" ? "checked" : ""}} name="contenido" value="1" id=1>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Teoria
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contenido" value="2" id=2 {{$horario->contenido == "Práctica" ? "checked" : ""}}>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Practica
                    </label>
                </div>
            </div>


                <div class="form-group col-md-4">
                    <label for="tipo_maquina" class="col-sm-2 col-form-label">Tipo Maquina</label>
                    <div class="col-sm-9">
                        <select name='tipo_maquina'  class="form-control {{$errors->first('tipo_maquina') ? "is-invalid" : "" }} " id="tipo_maquina">
                            @foreach ($tipo_maq as $tipo_maq)
                                @if($tipo_maq->id == $tipos[0] || $tipo_maq->id == $tipos[1] || $tipo_maq->id == $tipos[2] || $tipo_maq->id == $tipos[3])
                                <option value="{{ $tipo_maq->id }}" {{$horario->tipo_maquina == $tipo_maq->id ? "selected" : ""}}>{{ $tipo_maq->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_maquina') }}
                        </div>
                    </div>
                </div>




            <div class="form-group col-md-4">
                <label for="alumnos" class="col-sm-2 col-form-label">Alumnos</label>
                <div class="col-sm-10">
                    <input type="text" name='alumnos' class="form-control {{$errors->first('alumnos') ? "is-invalid" : "" }} " value="{{old('alumnos') ? old('alumnos') : $horario->alumnos}} " id="alumnos" placeholder="Número de asistentes

">
                    <div class="invalid-feedback">
                        {{ $errors->first('alumnos') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
            <label for="date" class="col-sm-4 col-form-label">Fecha Inicio</label>
            <div class="col-sm-9">
                <input type="datetime" dataformatas="" name='fecha_inicio' class="form-control {{$errors->first('fecha_inicio') ? "is-invalid" : "" }} " value="{{old('fecha_inicio') ? old('fecha_inicio') : $horario->fecha_inicio}}" id="fecha_inicio" >
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_inicio') }}
                </div>
            </div>
            </div>
            <div class="form-group col-md-4">
            <label for="date" class="col-sm-2 col-form-label">final</label>
            <div class="col-sm-9">
                <input type="datetime" name='final' class="form-control {{$errors->first('final') ? "is-invalid" : "" }} " value="{{old('final') ? old('final') : $horario->final}}"  id="final" >
                <div class="invalid-feedback">
                    {{ $errors->first('final') }}
                </div>
            </div>
            </div>
            </div>
            <div class="form-group col-md-4">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-info">{{__('message.Update')}}</button>
                </div>
            </div>
        </div>

    </form>
@endsection
