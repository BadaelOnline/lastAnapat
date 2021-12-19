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


    <form action="{{ route('admin.asistent.update',$asistent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--first row--}}
        <div class="form-groups">
        
                <div class="form-group col-md-4">
                    <label for="curso" class="col-sm-2 col-form-label">curso</label>
                    <div class="col-sm-9">
                        <select name='curso' class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " id="curso">
                            @foreach ($curso as $curso)
                                <option value="{{ $curso->id }}" {{$asistent->curso == $curso->id ? "selected" : ""}}>{{ $curso->codigo }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('curso') }}
                        </div>
                    </div>
                </div>



        {{--second row--}}

                <div class="form-group col-md-4">
                    <label for="orden" class="col-sm-2 col-form-label">Orden</label>
                    <div class="col-sm-9">
                        <input type="number" name='orden' class="form-control {{$errors->first('orden') ? "is-invalid" : "" }} " value="{{old('orden') ? old('orden') : $asistent->orden}}" id="orden" placeholder="Número de asistente">
                        <div class="invalid-feedback">
                            {{ $errors->first('orden') }}
                        </div>
                    </div>
                </div>
     

                <div class="form-group col-md-4">
                    <label for="operador" class="col-sm-2 col-form-label">Operador</label>
                    <div class="col-sm-9">
                        <select name='operador' class="form-control {{$errors->first('operador') ? "is-invalid" : "" }} " id="operador">

                            @foreach ($operador as $operador)
                                <option value="{{ $operador->id }}" {{$asistent->operador == $operador->id ? "selected" : ""}}>{{ $operador->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('operador') }}
                        </div>
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label for="tipo_carnet" class="col-sm-2 col-form-label">Tipo Carnet</label>
                    <div class="col-sm-9">
                        <select name='tipo_carnet' class="form-control {{$errors->first('tipo_carnet') ? "is-invalid" : "" }} " id="tipo_carnet">

                            @foreach ($tipo_carnet as $tipo_carnet)
                                <option value="{{ $tipo_carnet->id }}" {{$asistent->tipo_carnet == $tipo_carnet->id ? "selected" : ""}}>{{ $tipo_carnet->formacion }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_carnet') }}
                        </div>
                    </div>
                </div>
   




        {{--third row--}}

                <div class="form-group col-md-4">
                    <label for="nota_t" class="col-sm-2 col-form-label">Nota_t</label>
                    <div class="col-sm-9">
                        <input type="number" name='nota_t' class="form-control {{$errors->first('nota_t') ? "is-invalid" : "" }} " value="{{old('nota_t') ? old('nota_t') : $asistent->nota_t}}" id="Nota examen teórico" >
                        <div class="invalid-feedback">
                            {{ $errors->first('nota_t') }}
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="nota_p" class="col-sm-2 col-form-label">Nota_p</label>
                    <div class="col-sm-9">
                        <input type="number" name='nota_p' class="form-control {{$errors->first('nota_p') ? "is-invalid" : "" }} " value="{{old('nota_p') ? old('nota_p') : $asistent->nota_p}}" id="Nota examen práctico" >
                        <div class="invalid-feedback">
                            {{ $errors->first('nota_p') }}
                        </div>
                    </div>
                </div>
   


        {{--fourth row--}}
 
                <div class="form-group col-md-4">
                    <label for="examen_t_pdf" class="col-sm-2 col-form-label">Examen_t_pdf</label>
                    <div class="col-sm-9">
                        <input type="file" name='examen_t_pdf' class="form-control {{$errors->first('examen_t_pdf') ? "is-invalid" : "" }} " value="{{old('examen_t_pdf') ? old('examen_t_pdf') : $asistent->examen_t_pdf}}" id="examen_t_pdf" >
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_t_pdf') }}
                        </div>
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label for="examen_p_pdf" class="col-sm-2 col-form-label">Examen_p_pdf</label>
                    <div class="col-sm-9">
                        <input type="file" name='examen_p_pdf' class="form-control {{$errors->first('examen_p_pdf') ? "is-invalid" : "" }} " value="{{old('examen_p_pdf') ? old('examen_p_pdf') : $asistent->examen_p_pdf}}"  id="examen_p_pdf" placeholder="examen_p_pdf ">
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_p_pdf') }}
                        </div>
                    </div>
                </div>
  
                <div class="form-group col-md-4">
                    <label for="observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-9">
                        <input type="text" name='observaciones' class="form-control {{$errors->first('observaciones') ? "is-invalid" : "" }} " value="{{old('observaciones') ? old('observaciones') : $asistent->observaciones}}" id="observaciones" placeholder="Comentarios ">
                        <div class="invalid-feedback">
                            {{ $errors->first('observaciones') }}
                        </div>
                    </div>
                </div>
 


        {{--fifth row--}}
  
                <div class="form-group col-md-4">
                    <label for="emision" class="col-sm-2 col-form-label">Emision</label>
                    <div class="col-sm-9">
                        <input type="date" name='emision' class="form-control {{$errors->first('emision') ? "is-invalid" : "" }} " value="{{old('emision') ? old('emision') : $asistent->emision}}"  id="emision" placeholder="Fecha de emisión">
                        <div class="invalid-feedback">
                            {{ $errors->first('emision') }}
                        </div>
                    </div>
                </div>
    
 
                <div class="form-group col-md-4">
                    <label for="vencimiento" class="col-sm-2 col-form-label">Vencimiento</label>
                    <div class="col-sm-9">
                        <input type="date" name='vencimiento' class="form-control {{$errors->first('vencimiento') ? "is-invalid" : "" }} " value="{{old('vencimiento') ? old('vencimiento') : $asistent->vencimiento}}"  id="vencimiento" >
                        <div class="invalid-feedback">
                            {{ $errors->first('vencimiento') }}
                        </div>
                    </div>
                </div>
          
 
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

                <div class="form-group col-md-4">
                    <label for="tipo_1" class="col-sm-2 col-form-label">Tipo_1</label>
                    <div class="col-sm-9">
                        <select name='tipo_1' class="form-control {{$errors->first('tipo_1') ? "is-invalid" : "" }} " id="tipo_1">

                            @foreach ($tipo as $tipo_1)
                                <option value="{{ $tipo_1->id }}" {{$asistent->tipo_1 == $tipo_1->id ? "selected" : ""}}>{{ $tipo_1->practica }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
   

                <div class="form-group col-md-4">
                    <label for="tipo_2" class="col-sm-2 col-form-label">Tipo_2</label>
                    <div class="col-sm-9">
                        <select name='tipo_2' class="form-control {{$errors->first('tipo_2') ? "is-invalid" : "" }} " id="tipo_2">

                            @foreach ($tipo as $tipo_2)
                                <option value="{{ $tipo_2->id }}" {{$asistent->tipo_2 == $tipo_2->id ? "selected" : ""}}>{{ $tipo_2->practica }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label for="tipo_4" class="col-sm-2 col-form-label">Tipo_4</label>
                    <div class="col-sm-9">
                        <select name='tipo_4' class="form-control {{$errors->first('tipo_4') ? "is-invalid" : "" }} " id="tipo_4">
                            <option disabled selected>Choose One!</option>
                            @foreach ($tipo as $tipo_4)
                                <option value="{{ $tipo_4->id }}" {{$asistent->tipo_4 == $tipo_4->id ? "selected" : ""}}>{{ $tipo_4->practica }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
   


                <div class="form-group col-md-4">
                    <label for="tipo_3" class="col-sm-2 col-form-label">Tipo_3</label>
                    <div class="col-sm-9">
                        <select name='tipo_3' class="form-control {{$errors->first('tipo_3') ? "is-invalid" : "" }} " id="tipo_3">
                            <option disabled selected>Choose One!</option>
                            @foreach ($tipo as $tipo_3)
                                <option value="{{ $tipo_3->id }}" {{$asistent->tipo_3 == $tipo_3->id ? "selected" : ""}}>{{ $tipo_3->practica }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
        <div class="container">
            <div class="row">
                <div class="form-group ml-5">

                    <div class="col-sm-3">

                        <button type="submit" class="btn btn-info">Editar</button>

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
