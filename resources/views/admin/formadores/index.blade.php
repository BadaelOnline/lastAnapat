@extends('layouts.admin')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>

@endsection

@section('content')

    <!-- Page Heading -->

    <h1 class="h3 mb-2 text-gray-800">Formadores</h1>

    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- DataTales Example -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            @if(auth()->user()->perfil=='Administrador')
                <a href="{{ route('admin.formadores.create') }}" class="btn btn-pass">{{__('message.add_new')}}
                    formador</a>
                    <a href="{{ route('admin.formadores.export',auth()->user()->entidad) }}" class="btn btn-primary">
                        {{__('message.Exportar Formadores')}}
                    </a>

            @endif


        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>

                    <tr>

                        <th>{{__('message.Codigo')}}</th>

                        <th>{{__('message.Nombre')}} </th>

                        <th>{{__('message.Apellidos')}} </th>

                        <th>{{__('message.DNI')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                    </thead>

                    <tbody>

                    @php

                        $no=0;

                    @endphp

                    @foreach ($formadores as $formadores)
                        @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$formadores->entidad)
                            || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$formadores->entidad))
                            <tr>
                                <td>{{ $formadores->codigo }}</td>
                                <td> {{ $formadores->nombre }} </td>
                                <td>{{ $formadores->apellidos }}</td>
                                <td>
                                    <img src="{{asset('storage/' . $formadores->dni_img)}}" width="96px" id="myImg{{$formadores->dni_img}}" onclick="show( this);"/>
                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="img01">
                                        <div id="caption"></div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('admin.formadores.edit', [$formadores->id])}}"
                                       class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>

                                    @if(auth()->user()->perfil=='Administrador')
                                        <form method="POST"
                                              action="{{route('admin.formadores.destroy', [$formadores->id])}}"
                                              class="d-inline"
                                              onsubmit="return confirm('{{__("message.Delete permanently?")}}')">

                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                                <i class='fas fa-trash-alt'></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function show(elem) {
// Get the modal
//             console.log(id);
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");

                modal.style.display = "block";
                modalImg.src = $(elem).attr('src');
                // captionText.innerHTML = this.alt;


            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        }

    </script>

    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
