@extends('layouts.admin')

@section('styles')
@section('styles')
<style>
   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width:300px;
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

<form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-groups">
        <div class="form-group col-md-4">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" name='name' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="Ex: Susi Similikiti">
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            </div>
        </div>

          <div class="form-group col-md-4 ">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" name='email' class="form-control {{$errors->first('email') ? "is-invalid" : "" }} " value="{{old('email')}}" id="email" placeholder="Email">
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            </div>
        </div>

      
          
     
        @can('isAdmin')
        <div class="form-group col-md-4 ">
            <label for="entidad" class="col-sm-2 col-form-label">Perfil</label>
            <div class="col-sm-9">
                <select name='perfil' class="form-control {{$errors->first('perfil') ? "is-invalid" : "" }} " id="perfil" style="appearance: auto;">
                    <option disabled selected>{{__('message.Choose_One')}}</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Responsable_de_Formacion">Responsable de Formación</option>
                        <option value="Formador">Formador</option>
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('perfil') }}
                </div>
            </div>
            </div>
        @endcan

        @can('isResponsable')

        <div class="form-group col-md-4">
            <div class="col-sm-9">
                <input type="hidden" name='perfil' class="form-control {{$errors->first('perfil') ? "is-invalid" : "" }} " value="Formador" id="perfil" placeholder="perfil">
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            </div>
        </div>
        @endcan

         <div class="form-group col-md-4 ">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" name='password' class="form-control {{$errors->first('password') ? "is-invalid" : "" }} " value="{{old('password')}}" id="password" placeholder="Password">
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            </div>
        </div>


        <div class="form-group col-md-4">
            <label for="apellidos" class="col-sm-2 col-form-label">Alias </label>
            <div class="col-sm-9">
                <input type="text" placeholder="Alias" name="alias" id="alias" cols="40" rows="10"  class="form-control {{$errors->first('alias') ? "is-invalid" : "" }} ">{{old('alias')}}</input>
                <div class="invalid-feedback">
                    {{ $errors->first('alias') }}
                </div>
            </div>
        </div>


        <div class="form-group col-md-4">
            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos </label>
            <div class="col-sm-9">
                <input type="text" placeholder="Apellidos del Formador Name" name="apellidos" id="apellidos" cols="40" rows="10"  class="form-control {{$errors->first('apellidos') ? "is-invalid" : "" }} ">{{old('apellidos')}}</input>
                <div class="invalid-feedback">
                    {{ $errors->first('apellidos') }}
                </div>

            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
            <div class="col-sm-9">
                {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                <input type="text" name="nombre" placeholder="Nombre del formador" id="nombre" cols="40" rows="10"  class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} ">{{old('nombre')}}</input>
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            </div>
        </div>
     <div class="form-group col-md-4">
            <label for="ciudad" class="col-sm-2 col-form-label">Ciudad</label>
            <div class="col-sm-7">
                <input type="text" name='ciudad' class="form-control {{$errors->first('ciudad') ? "is-invalid" : "" }} " value="{{old('ciudad')}}" id="ciudad" placeholder="Ciudad de la sede">
                <div class="invalid-feedback">
                    {{ $errors->first('ciudad') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="direccion" class="col-sm-2 col-form-label">direccion</label>
            <div class="col-sm-7">
                <input type="text" name='direccion' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Domicilio de la sede">
                <div class="invalid-feedback">
                    {{ $errors->first('linkedin') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="codigo_postal" class="col-sm-2 col-form-label">codigo_postal</label>
            <div class="col-sm-7">
                <input type="number" name='codigo_postal' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Código postal de la sede">
                <div class="invalid-feedback">
                    {{ $errors->first('linkedin') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="entidad" class="col-sm-2 col-form-label">Entidad</label>
            <div class="col-sm-9">
                <select name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} " id="entidad" style="appearance: auto;">
                    <option disabled selected>{{__('message.Choose_One')}}</option>
                    @foreach ($entidad as $entidad)
                        <option value="{{ $entidad->id }}">{{ $entidad->nombre }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('entidad') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="estado" class="col-sm-2 col-form-label">Estado</label>
            <div class="col-sm-9">
                {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                <label for="estado" class="col-sm-2 col-form-label">yes <input type="radio" name='estado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="1" id="linkedin" placeholder="Indicador de certificación"></label>
                <label for="estado" class="col-sm-2 col-form-label">no <input type="radio" name='estado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="0" id="linkedin" placeholder="Indicador de certificación" checked="checked"></label>
                <div class="invalid-feedback">
                    {{ $errors->first('estado') }}
                </div>
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
