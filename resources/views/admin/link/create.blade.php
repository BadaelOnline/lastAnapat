@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.link.store') }}" method="POST">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="name" class="col-sm-2 col-form-label">{{__('message.Title')}}</label>

            <div class="col-sm-7">

                <input type="text" name='name' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="{{__('message.Title')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>
        <div class="form-group ml-5">

            <label for="answer" class="col-sm-2 col-form-label">{{__('message.desc')}}</label>

            <div class="col-sm-7">

                <textarea name="answer" class="form-control {{$errors->first('answer') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('answer')}}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('answer') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="link" class="col-sm-2 col-form-label">{{__('message.Link')}}</label>

            <div class="col-sm-7">

                <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} " value="{{old('link')}}" id="link" placeholder="{{__('message.Link')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('link') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{__('message.Create')}}</button>

            </div>

        </div>

    </div>

  </form>
@endsection
