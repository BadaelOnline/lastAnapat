@extends('layouts.front')

@section('content')
<main id="main">

    <!-- ======= Testimonials Section ======= -->
    <section class="courses">
      <div class="container">
      <h2 class="title" style="margin: 50px 0;">Courses show</h2>
        <div class="row">

        <div class="d-flex justify-content-center contain-card">
        <div class="card">
            
              <h2>ALQUILER DE MAQUINARIA RENTAIRE</h2>
              <div class="d-flex align-items-center">
                <h3>Ciudad : Madrid <br>
                    Socio : 49
                </h3>  
                <img class="image" src="{{ asset('front/img/haulotte.png')}}" alt=""></div>
              <hr/>
             <p>Dirección : Pol. Ind. Európolis C / París, 6</p>
             <p>Razón social : ALQUILER DE MAQUINARIA RENTAIRE, S. A.</p>
             <p>Codigo postal : 28231</p>
             <p>mail : infomadrid@rentaire.es</p>
             <p>Fecha : junio 12, 2014 </p>
             <p>Certificada : Yes</p>
              <p></p>
              <div class="d-flex justify-content-center">
              <a href="">Show Assistants</a>
              <span class="ml-3 mr-3">or</span>
              <a href="">Download</a>
              </div>
              <p></p>
              <button>Web</button>
        </div>
      </div>

        </div>
      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->
@endsection