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

<form action="{{ route('admin.partner.update',$partner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container">

        <div class="form-group">

            <div class="picture-container">

                <div class="picture">

                    <img src="{{ asset('storage/'.$partner->cover) }}" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture" name="logo" class="form-control {{$errors->first('logo') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>

                </div>

                <h6>{{__('message.Logo')}}</h6>

            </div>

        </div>


        <div class="form-group ml-5">

            <label for="nombre" class="col-sm-2 col-form-label">{{__('message.Name')}}</label>

            <div class="col-sm-9">

                <input type="text" name='nombre' class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre') ? old('nombre') : $partner->name}}" id="nombre" placeholder="Nombre">

                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="enlace" class="col-sm-2 col-form-label">{{__('message.Link')}}</label>

            <div class="col-sm-9">

                <input type="text" name='enlace' class="form-control {{$errors->first('enlace') ? "is-invalid" : "" }} " value="{{old('enlace') ? old('enlace') : $partner->link}}" id="enlace" placeholder="ex: Wiklop.com">

                <div class="invalid-feedback">
                    {{ $errors->first('enlace') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{__('message.Update')}}</button>

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
