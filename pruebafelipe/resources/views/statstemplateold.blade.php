<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiE </title>

    {!!Html::style('css/bootstrap.min.css')!!}
     {!!Html::style('css/bootstrap.css')!!}
    {!!Html::style('font-awesome/css/font-awesome.css')!!}

    {!!Html::style('css/plugins/sweetalert/sweetalert.css')!!}
    {!!Html::style('css/plugins/toastr/toastr.min.css')!!}

    {!!Html::style('css/animate.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/checkbox.css')!!}



    {!!Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

    {!!Html::style('css/plugins/switchery/switchery.css') !!}

    @section('style')
    @show

    <style>
    .stats-header{
      height: auto;
      width: 230px;
      padding:40px;
      position: fixed;
      top: 0;
      left: 0;
    }

    .stats-menu{

      width: 230px;
      margin: auto;

      height: 500px;
      position: fixed;
      left: 0;
    }

    .stats-button{
      background-color: transparent;
      border-color: transparent;
      text-align: left;
      margin:auto;
      width: 230px;
      border-radius: 0;
      padding-left: 40px;
      font-size: 16px;
      height: 40px;
    }
    </style>

    <!-- Facebook Open Graph -->
      <meta property="og:type" content="website"/>
      <meta property="og:title" content="Estadísticas EPSUM"/>
      <meta property="og:description" content="Conoce el Programa EPSUM-USAC ¡en cifras!"/>
      <meta property="og:image" content="{{asset('img/card-4.png')}}"/>

    <!-- Twitter Cards -->
      <meta name="twitter:card" content="summary_large_image"/>
      <meta name="twitter:title" content="Estadísticas EPSUM"/>
      <meta name="twitter:description" content="Conoce el Programa EPSUM-USAC ¡en cifras!"/>
      <meta name="twitter:image" content="{{asset('img/card-4.png')}}">

</head>
<body  class="">

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        <div>
          <div class="stats-header">
            <a  href="{{url('stats/')}}"><img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="100px" height="auto" style="padding-bottom:0; cursor: pointer;" onclick=""></a>
            <p style="color:white;font-size:20px;font-weight:bold;margin-bottom:0px;">ESTADÍSTICAS</p>
            <p style="color:white;font-size:12px;margin-top:0px;">EPSUM</p>
          </div>
          <div class="stats-menu">

            <a href="{{url('stats/students')}}" class="btn btn-primary stats-button" style="margin-top:200px;" > Estudiantes </a>
            <a href="{{url('stats/financing')}}" class="btn btn-primary stats-button" > Financiamiento </a>
            <a href="{{url('stats/teams')}}" class="btn btn-primary stats-button"> Equipos </a>
            <a href="{{url('stats/diagnostics')}}" class="btn btn-primary stats-button"> Diagnósticos </a>
            <a href="{{url('stats/projects')}}" class="btn btn-primary stats-button"> Proyectos </a>
            <hr style="border-color:#ffffff22">
            <a href="{{url('map/')}}" class="btn btn-primary stats-button"> Ir a Geoportal </a>
            <a href="{{url('login/')}}" class="btn btn-primary stats-button"> Ir a MiE 2.0 </a>

            <div style="padding:40px;font-size:12px;color:white;margin-top:25px;">
              <p style="font-weight:bold;margin-bottom:0px;">EPSUM 2018</p>
              <p style="margin-top:0px;color:#2ebeef"><a data-toggle="modal" data-target="#modalInfo">Más información</a></p>
            </div>

          </div>
        </div>
        <!-- Page wraper -->
        <div id="page-wrapper" style="background-color:white">

            <!-- Main view  -->
            <div class="wrapper wrapper-content animated fadeInRight">
            @yield('place')
            </div>


        <!-- Footer -->
        @include('template/footer')
        </div>
    </div>

    <div class="modal inmodal" id="modalInfo" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="fa fa-info-circle modal-icon"></i>
            <h1 class="modal-title">Estadísticas de EPSUM</h1>
          </div>
          <div class="modal-body">
            <p>Estadísticas de EPSUM es un proyecto basado en los datos registrados en el Sistema MiE 2.0, mismos que son ingresados por los estudiantes como parte de su trabajo realizado con EPSUM, desde su proceso de registro en la plataforma, hasta el ingreso de sus informes diagnósticos y de proyectos.</p>

            <p><strong>Estadísticas de EPSUM fue desarrollado por Carlos Paiz, de la Carrera de Ingeniería en Ciencias y Sistemas, del Centro Universitario de Oriente. Guatemala, 2018.<br><br>"Id y enseñad a todos."</strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">¡Entendido!</button>
          </div>
        </div>
      </div>
    </div>

    @include('template/scripts')

    @section('script')
    @show

</body>
</html>
