@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.faq.store') }}" method="POST">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="question" class="col-sm-2 col-form-label">{{__('message.Tipo de PEMPA')}}</label>

            <div class="col-sm-7">

                <input type="text" name='question' class="form-control {{$errors->first('question') ? "is-invalid" : "" }} " value="{{old('question')}}" id="question" placeholder="{{__('message.Tipo de PEMPA')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('question') }}
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

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{__('message.Create')}}</button>

            </div>

        </div>

    </div>

  </form>
@endsection
