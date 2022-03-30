@extends('layouts.admin')


@section('styles')
    <style>
        .picture-container {
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture {
            width: 800px;
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
    </style>
@endsection
@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <form action="{{ route('admin.asistent.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--first row--}}
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="curso" class="col-sm-2 col-form-label">{{__('message.Curso')}}</label>
                    <div class="col-sm-9">

{{--                        <select disabled name='test' class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " id="curso">--}}
{{--                            <option disabled selected>{{__('message.Choose_One')}}</option>--}}
                            @foreach ($curso as $curso)
{{--                            <label>{{$curso}}</label>--}}
                                @if($id == $curso->id)
                                <input type="text" value="{{ $curso->codigo }}" readonly class="form-control">
                                @endif
{{--                                <option value="{{ $curso->id }}" {{$id == $curso->id ? "selected" : ""}}>{{ $curso->codigo }}</option>--}}
                            @endforeach
{{--                        </select>--}}
                        <input type="hidden" name="curso" value="{{$id}}">
                        <div class="invalid-feedback">
                            {{ $errors->first('curso') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--second row--}}
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="orden" class="col-sm-2 col-form-label">{{__('message.Orden')}}</label>
                    <div class="col-sm-9">
                        <input type="number" name='orden' class="form-control {{$errors->first('orden') ? "is-invalid" : "" }} " value="{{old('orden') != null ? old('orden') : $orden}}" id="orden" placeholder="Número de asistente">
                        <div class="invalid-feedback">
                            {{ $errors->first('orden') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="operador" class="col-sm-2 col-form-label">{{__('message.OPERADOR')}}</label>
                    <div class="col-sm-9">
                        <select name='operador' class="form-control {{$errors->first('operador') ? "is-invalid" : "" }} " id="operador">
                            <option disabled selected>{{__('message.Choose_One')}}</option>
                            @foreach ($operador as $operador)
                                <option value="{{ $operador->id }}" {{old('operador') == $operador->id ? "selected" : ""}}>{{ $operador->nombre }}  {{ $operador->apellidos }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('operador') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->perfil=='Administrador' )
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <label for="tipos_carnet" class="col-sm-2 col-form-label">{{__('message.tipo_carnet')}}</label>
                        <div class="col-sm-9">
                            @foreach ($cursos as $cur)
                                @if($id == $cur->id)
                                    <input readonly type="text"  class="form-control {{$errors->first('tipos_carnet') ? "is-invalid" : "" }} " value="{{old('tipos_carnet') ? old('tipos_carnet') : $cur->tipo_de_curso->tipo_curso == 'Básico' ? 'B' : 'R' }}" id="Nota examen teórico" placeholder="{{__('message.tipo_carnet')}}">
                                    <input type="hidden" name="tipos_carnet" value="{{$cur->tipo_de_curso->tipo_curso == 'Básico' ? 'B' : 'R'}}">
                                @endif
                            @endforeach
                            <div class="invalid-feedback">
                                {{ $errors->first('nota_t') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="tipo_carnet" value="0">
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm">--}}
{{--                    <label for="tipo_carnet" class="col-sm-2 col-form-label">{{__('message.tipo_carnet')}}</label>--}}
{{--                    <div class="col-sm-9">--}}
{{--                        <select name='tipo_carnet' class="form-control {{$errors->first('tipo_carnet') ? "is-invalid" : "" }} " id="tipo_carnet">--}}
{{--                            <option disabled selected>{{__('message.Choose_One')}}</option>--}}
{{--                            @foreach ($tipo_carnet as $tipo_carnet)--}}
{{--                                <option value="{{ $tipo_carnet->id }}" {{old('tipo_carnet') == $tipo_carnet->id ? "selected" : ""}}>{{ $tipo_carnet->formacion }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <div class="invalid-feedback">--}}
{{--                            {{ $errors->first('tipo_carnet') }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @else
            <input type="hidden" name="tipo_carnet" value="0">
        @endif

        {{--third row--}}
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="nota_t" class="col-sm-2 col-form-label">{{__('message.Nota_t')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name='nota_t' class="form-control {{$errors->first('nota_t') ? "is-invalid" : "" }} " value="{{old('nota_t')}}" id="Nota examen teórico" >
                        <div class="invalid-feedback">
                            {{ $errors->first('nota_t') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="nota_p" class="col-sm-2 col-form-label">{{__('message.Nota_p')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name='nota_p' class="form-control {{$errors->first('nota_p') ? "is-invalid" : "" }} " value="{{old('nota_p')}}" id="Nota examen práctico" >
                        <div class="invalid-feedback">
                            {{ $errors->first('nota_p') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--fourth row--}}
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="examen_t_pdf" class="col-sm-4 col-form-label">{{__('message.Exámen Teórico')}}</label>
                    <div class="col-sm-9">
                        <input type="file" name='examen_t_pdf' class="form-control {{$errors->first('examen_t_pdf') ? "is-invalid" : "" }} " value="{{old('examen_t_pdf')}}" id="examen_t_pdf" >
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_t_pdf') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="examen_p_pdf" class="col-sm-4 col-form-label">{{__('message.Exámen Práctico')}}</label>
                    <div class="col-sm-9">
                        <input type="file" name='examen_p_pdf' class="form-control {{$errors->first('examen_p_pdf') ? "is-invalid" : "" }} " value="{{old('examen_p_pdf')}}" id="examen_p_pdf" placeholder="examen_p_pdf ">
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_p_pdf') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="observaciones" class="col-sm-2 col-form-label">{{__('message.Observaciones')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name='observaciones' class="form-control {{$errors->first('observaciones') ? "is-invalid" : "" }} " value="{{old('observaciones')}}" id="observaciones" placeholder="Comentarios ">
                        <div class="invalid-feedback">
                            {{ $errors->first('observaciones') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @if(auth()->user()->perfil=='Administrador' ) {{--fifth row--}}
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="emision" class="col-sm-2 col-form-label">{{__('message.Emision')}}</label>
                    <div class="col-sm-9">
                        <input type="date" name='emision' class="form-control {{$errors->first('emision') ? "is-invalid" : "" }} " value="{{old('emision')}}" id="emision" placeholder="Fecha de emisión">
                        <div class="invalid-feedback">
                            {{ $errors->first('emision') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="vencimiento" class="col-sm-2 col-form-label">{{__('message.Vencimiento')}}</label>
                    <div class="col-sm-9">
                        <input type="date" name='vencimiento' class="form-control {{$errors->first('vencimiento') ? "is-invalid" : "" }} " value="{{old('vencimiento')}}" id="vencimiento" >
                        <div class="invalid-feedback">
                            {{ $errors->first('vencimiento') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        @endif
        {{--    <div class="container">--}}
        {{--        <div class="row">--}}
        {{--            <div class="col-sm">--}}
        {{--                <label for="rememberToken" class="col-sm-2 col-form-label">RememberToken</label>--}}
        {{--                <div class="col-sm-9">--}}
        {{--                    <input type="text" name='rememberToken' class="form-control {{$errors->first('rememberToken') ? "is-invalid" : "" }} " value="{{old('rememberToken')}}" id="rememberToken" >--}}
        {{--                    <div class="invalid-feedback">--}}
        {{--                        {{ $errors->first('rememberToken') }}--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        {{--sixth row--}}
        @if(auth()->user()->perfil=='Administrador' )
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="tipo_1" class="col-sm-2 col-form-label">{{__('message.Tipo_1')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_1' class="form-control {{$errors->first('tipo_1') ? "is-invalid" : "" }} " id="tipo_1">
                            <option disabled selected>Choose One!</option>
                            @foreach ($tipo as $tipo_1)
                                @if($tipo_1->id == $tipos[0] || $tipo_1->id == $tipos[1] || $tipo_1->id == $tipos[2] || $tipo_1->id == $tipos[3])
                                <option value="{{ $tipo_1->id }}" {{old('tipo_1') == $tipo_1->id ? "selected" : ""}}>{{ $tipo_1->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="tipo_2" class="col-sm-2 col-form-label">{{__('message.Tipo_2')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_2' class="form-control {{$errors->first('tipo_2') ? "is-invalid" : "" }} " id="tipo_2">
                            <option disabled selected>Choose One!</option>
                            @foreach ($tipo as $tipo_2)
                                @if($tipo_2->id == $tipos[0] || $tipo_2->id == $tipos[1] || $tipo_2->id == $tipos[2] || $tipo_2->id == $tipos[3])
                                <option value="{{ $tipo_2->id }}" {{old('tipo_2') == $tipo_2->id ? "selected" : ""}}>{{ $tipo_2->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="tipo_3" class="col-sm-2 col-form-label">{{__('message.Tipo_3')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_3' class="form-control {{$errors->first('tipo_3') ? "is-invalid" : "" }} " id="tipo_3">
                            <option disabled selected>Choose One!</option>
                            @foreach ($tipo as $tipo_3)
                                @if($tipo_3->id == $tipos[0] || $tipo_3->id == $tipos[1] || $tipo_3->id == $tipos[2] || $tipo_3->id == $tipos[3])
                                <option value="{{ $tipo_3->id }}" {{old('tipo_3') == $tipo_3->id ? "selected" : ""}}>{{ $tipo_3->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <label for="tipo_4" class="col-sm-2 col-form-label">{{__('message.Tipo_4')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_4' class="form-control {{$errors->first('tipo_4') ? "is-invalid" : "" }} " id="tipo_4">
                            <option disabled selected>Choose One!</option>
                            @foreach ($tipo as $tipo_4)
                                @if($tipo_4->id == $tipos[0] || $tipo_4->id == $tipos[1] || $tipo_4->id == $tipos[2] || $tipo_4->id == $tipos[3])
                                <option value="{{ $tipo_4->id }}" {{old('tipo_4') == $tipo_4->id ? "selected" : ""}}>{{ $tipo_4->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @else
            <input type="hidden" name="tipo_1" value="0">
            <input type="hidden" name="tipo_2" value="0">
            <input type="hidden" name="tipo_3" value="0">
            <input type="hidden" name="tipo_4" value="0">
        @endif
        <div class="container">
            <div class="row">
                <div class="form-group ml-5">

                    <div class="col-sm-3">

                        <button type="submit" class="btn btn-primary">{{__('message.Create')}}</button>

                    </div>

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
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
