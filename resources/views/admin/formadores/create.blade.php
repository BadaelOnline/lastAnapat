@extends('layouts.admin')

@section('styles')

    <style>
        .picture-container {
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture {
            width: 300px;
            height: 400px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;
            /* border-radius: 50%; */
            margin: 5px auto;
            overflow: hidden;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }
        .picture:hover {
            border-color: #2ca8ff;
        }
        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }
        .picture-src {
            width: 100%;
            height: 100%;
        }
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


    <form action="{{ route('admin.formadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="codigo" class="col-sm-2 col-form-label">Codigo</label>

                <div class="col-sm-9">
                    <input type="text" name='codigo' class="form-control {{$errors->first('codigo') ? "is-invalid" : "" }} " value="{{old('name')}}" id="codigo" placeholder="Código del Formador
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
                            <option value="{{ $entidad->id }}" >{{ $entidad->nombre }}</option>
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

                    <input type="text" placeholder="Apellidos del Formador Name" name="apellidos" id="apellidos" cols="40" rows="10"  class="form-control {{$errors->first('apellidos') ? "is-invalid" : "" }} " value="{{old('name')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('apellidos') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" name="nombre" placeholder="Nombre del formador" id="nombre" cols="40" rows="10"  class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('name')}}"></input>
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni" class="col-sm-2 col-form-label">DNI </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" placeholder="Documento identificación" name="dni" id="dni" cols="40" rows="10"  class="form-control {{$errors->first('dni') ? "is-invalid" : "" }} " value="{{old('name')}}"></input>
                    <div class="invalid-feedback">
                        {{ $errors->first('dni') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni_img" class="col-sm-2 col-form-label">DNI </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="dni_img" id="dni_img" cols="40" rows="10"  class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} " value="{{old('name')}}"></input>
                    <div class="invalid-feedback">
                        {{ $errors->first('dni_img') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="operador_pdf" class="col-sm-2 col-form-label">Operador pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="operador_pdf" id="operador_pdf" cols="40" rows="10"  class="form-control {{$errors->first('operador_pdf') ? "is-invalid" : "" }} ">{{old('operador_pdf')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('operador_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="cert_empresa_pdf" class="col-sm-2 col-form-label">Cert empresa pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="cert_empresa_pdf" id="cert_empresa_pdf" cols="40" rows="10"  class="form-control {{$errors->first('cert_empresa_pdf	') ? "is-invalid" : "" }} ">{{old('cert_empresa_pdf	')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('cert_empresa_pdf	') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="vida_laboral_pdf" class="col-sm-2 col-form-label">Vida laboral pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="vida_laboral_pdf" id="vida_laboral_pdf" cols="40" rows="10"  class="form-control {{$errors->first('vida_laboral_pdf') ? "is-invalid" : "" }} ">{{old('vida_laboral_pdf')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('vida_laboral_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="prl_pdf" class="col-sm-2 col-form-label">PRL pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="prl_pdf" id="prl_pdf" cols="40" rows="10"  class="form-control {{$errors->first('prl_pdf') ? "is-invalid" : "" }} ">{{old('prl_pdf')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('prl_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="pemp_pdf" class="col-sm-2 col-form-label">PEMP pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="pemp_pdf" id="pemp_pdf" cols="40" rows="10"  class="form-control {{$errors->first('pemp_pdf') ? "is-invalid" : "" }} ">{{old('pemp_pdf')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('pemp_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="cap_pdf" class="col-sm-2 col-form-label">CAP pdf</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="cap_pdf" id="cap_pdf" cols="40" rows="10"  class="form-control {{$errors->first('cap_pdf') ? "is-invalid" : "" }} ">{{old('cap_pdf')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('cap_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="fecha" class="col-sm-2 col-form-label">	Fecha</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="fecha" id="fecha" cols="40" rows="10"  class="form-control {{$errors->first('fecha') ? "is-invalid" : "" }} " value="{{old('name')}}">{{old('fecha')}}</input>
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="estado" class="col-sm-12 col-form-label  text-center">	Estado</label>
                <div class="col-sm-12  text-center">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <label for="estado" class="col-sm-2 col-form-label">yes <input type="radio" name='estado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="1" id="linkedin" placeholder="Indicador de certificación"></label>
                    <label for="estado" class="col-sm-2 col-form-label">no <input type="radio" name='estado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="0" id="linkedin" placeholder="Indicador de certificación" checked="checked"></label>
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12">

                <div class="col-sm-3">

                    <button type="submit" class="btn btn-info">Create</button>

                </div>

            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });
        //Function to show image before upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endpush
