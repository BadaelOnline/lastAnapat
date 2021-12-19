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

    <form action="{{ route('admin.entidades_formadoreas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="socio" class="col-sm-2 col-form-label">socio</label>

                <div class="col-sm-12">

                    <input type="number" name='socio' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="Código de socio">

                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="cif" class="col-sm-2 col-form-label">cif</label>

                <div class="col-sm-12">

                    <input type="text" name='cif' class="form-control {{$errors->first('position') ? "is-invalid" : "" }} " value="{{old('position')}}" id="position" placeholder="Código de identificación">

                    <div class="invalid-feedback">
                        {{ $errors->first('position') }}
                    </div>

                </div>

            </div>


            <div class="form-group col-md-4">

                <label for="nombre" class="col-sm-2 col-form-label">nombre</label>

                <div class="col-sm-12">

                    <input type="text" name='nombre' class="form-control {{$errors->first('twitter') ? "is-invalid" : "" }} " value="{{old('twitter')}}" id="twitter" placeholder="Nombre comercial">

                    <div class="invalid-feedback">
                        {{ $errors->first('twitter') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="razon_social" class="col-sm-2 col-form-label">razon_social</label>

                <div class="col-sm-12">

                    <input type="text" name='razon_social' class="form-control {{$errors->first('facebook') ? "is-invalid" : "" }} " value="{{old('facebook')}}" id="facebook" placeholder="Nombre de la empresa">

                    <div class="invalid-feedback">
                        {{ $errors->first('facebook') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="province" class="col-sm-2 col-form-label">province</label>

                <div class="col-sm-12">

                    <input type="text" name='province' class="form-control {{$errors->first('instagram') ? "is-invalid" : "" }} " value="{{old('instagram')}}" id="instagram" placeholder="Provincia de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('instagram') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="ciudad" class="col-sm-2 col-form-label">ciudad</label>

                <div class="col-sm-12">

                    <input type="text" name='ciudad' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Ciudad de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>




            <div class="form-group col-md-4">

                <label for="direccion" class="col-sm-2 col-form-label">direccion</label>

                <div class="col-sm-12">

                    <input type="text" name='direccion' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Domicilio de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="codigo_postal" class="col-sm-2 col-form-label">codigo_postal</label>

                <div class="col-sm-12">

                    <input type="number" name='codigo_postal' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Código postal de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="logo" class="col-sm-2 col-form-label">logo</label>

                <div class="col-sm-12">

                    <input type="file" name='logo' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Link Linkedin">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="web" class="col-sm-2 col-form-label">web</label>

                <div class="col-sm-12">

                    <input type="text" name='web' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="URL de la web">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="mail" class="col-sm-2 col-form-label">mail</label>

                <div class="col-sm-12">

                    <input type="text" name='mail' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Correo electrónico">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="doc_medios_pdf" class="col-sm-2 col-form-label">doc_medios_pdf</label>

                <div class="col-sm-12">

                    <input type="file" name='doc_medios_pdf' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Link Linkedin">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div><div class="form-group col-md-4">

                <label for="fecha" class="col-sm-2 col-form-label">fecha</label>

                <div class="col-sm-12">

                    <input type="date" name='fecha' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin')}}" id="linkedin" placeholder="Fecha de alta">

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-sm-4">

                <label for="estado" class="col-sm-12 col-form-label text-center">estado</label>

                <div class="col-sm-12 text-center">

                    <label for="estado" class="col-sm-5 col-form-label">yes <input type="radio" name='estado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="1" id="linkedin" placeholder="Indicador: Activa/Inactiva"></label>
                    <label for="estado" class="col-sm-5 col-form-label">no <input type="radio" name='estado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="0" id="linkedin" placeholder="Indicador: Activa/Inactiva" checked="checked"></label>

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>
            <div class="form-group  col-sm-4">

                <label for="certificado" class="col-sm-12 col-form-label text-center">certificado</label>

                <div class="col-sm-12 text-center">

                    <label for="certificado" class="col-sm-5 col-form-label">yes <input type="radio" name='certificado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="1" id="linkedin" placeholder="Indicador de certificación"></label>
                    <label for="certificado" class="col-sm-5 col-form-label">no <input type="radio" name='certificado' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="0" id="linkedin" placeholder="Indicador de certificación" checked="checked"></label>

                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>

                </div>

            </div>

            <div class="form-group  col-sm-12">
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
