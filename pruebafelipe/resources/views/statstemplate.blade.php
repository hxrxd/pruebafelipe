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

    {!! Html::style('css/plugins/sweetalert/sweetalert.css')!!}
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    {!! HTML::script('js/plugins/sweetalert/sweetalert.min.js') !!}
    
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

    .control-menu {
      background-color: transparent;
      background-position: center center;
      
      display: block;
      float: right;
      height: 40px;
      margin-right: 1.3em;
      width: 40px;
    }
    .control-menu a span {
        display: inline-block;
        height: 40px;
        text-indent: -9999px;
        width: 40px;
    }
    .control-menu .close {
        background-position: center center;
        background-repeat: no-repeat;
        display: none;
    }
    .control-menu .open {
        background-position: center center;
        background-repeat: no-repeat;
        display: block;
    }

    ul.nav-items {
        clear: both;
        height: 0;
        overflow: hidden;
        transition: height 0.4s ease-in-out 0s, background-color 2s ease 0s; /*El menú cambia su altura y su color de fondo mediante una transición suavizada al voover a su estado unicial*/
    }

    #navigation:target ul.nav-items {
        background: #f0f0f0 none repeat scroll 0 0;
        height: 26.4em;
        transition: height 0.4s ease-in-out 0s, background-color 0.9s ease 0s; /*El menú cambia su altura y su color de fondo mediante una transición suavizada al abrirse*/
    }


    /*Al hacer clic sobre el enlace que abre el menú éste desaparece*/
    .close { 
      display:none;
    }
            
    #navigation:target .open {
          display: none;
    }

    /* Al hacer clic sobre el enlace que abre el menú aparece el enlace .close que previamente estaba oculto*/

    #navigation:target .close {
            display: block;
    }
    /*Estilos menu*/

    ul.nav-items li {
        display: block;
    }
    ul.nav-items a {
        border-top: 2px dotted #dddbdb;
        color: #333;
        display: block;
        height: 3em;
        line-height: 3em;
        margin: 0 1.3em;
    }
    ul.nav-items li:first-child a {
        border-top: 2px solid transparent;
    }
    ul.nav-items li a span {
        border-left: 3px solid;
        height: 3.2em;
        padding: 0.4em 0.5em;
    }
    #Student a span {
        border-color: #02556e;
    }
    #Finances a span {
        border-color: #95b1c2;
    }
    #Teams a span {
        border-color: #2ebeef;
    }
    #Ind a span {
        border-color: #abe1fa;
    }
    #Diag a span {
        border-color: #a03522;
    }
    #Project a span {
        border-color: #d6acaa;
    }
  
    #Geo a span {
        border-color: #f68628;
    }
    #Mie a span {
        border-color: #fdcdab;
    }
    #Info a span {
        border-color: ##2f4050;
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
    <!-- view movil -->
        <div id="appbar" class="visible-xs visible-sm" style="background-color: #2f4050; width: 500;" >
          <h1 id="logo"><img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="48" height="32" style="cursor: pointer;" onclick=""></h1>
          <h5 style="text-align: center;"><a class="title-app" style="color:white;" width="48" height="32">ESTADÍSTICAS</a></h5>
          <nav id="navigation">

                    <div class="control-menu">
                        <a href="#navigation" class="open "><i class="fa fa-bars" style="font-size:31px; color: #F4F6F7;"></i></a>
                        <a href="#" class="close"><i class="fa fa-times" style="font-size:31px; color: #F4F6F7;"></i></a>
                    </div>

            
            <ul class="nav-items">
                    <li id="Student"><a href="{{url('stats/students')}}" > <span>Estudiantes</span> </a></li>
                    <li id="Finances"><a href="{{url('stats/financing')}}"  > <span>Financiamiento</span> </a></li>
                    <li id="Teams"><a href="{{url('stats/teams')}}" > <span>Equipos</span> </a></li>
                    <li id="Ind"><a href="{{url('stats/goodsservices')}}" > <span>Bienes y Servicios</span> <span class="label label-success">Nuevo</span></a></li>
                   <!-- <li id="Diag"><a href="{{url('stats/diagnostics')}}" > <span>Diagnósticos</span> </a></li>
                    <li id="Project"><a href="{{url('stats/projects')}}" > <span>Proyectos</span> </a></li>-->
                    <li id="Project"><a href="{{url('request/getRequest')}}" > <span>Solicitud de disciplinas</span> </a></li>
                    <li id="Geo"><a href="{{url('map/')}}" > <span>Ir a Geoportal</span> </a></li>
                    <li id="Mie"><a href="{{url('login/')}}" > <span>Ir a MiE 2.0</span> </a></li>
                    <li id="Info"><a data-toggle="modal" data-target="#modalInfo"><span>Más información</span></a></li>            
            </ul>

	      </nav>
        </div>
  <!-- Wrapper-->
    <div id="wrapper" >
        
        <!-- Navigation -->
        <div class="visible-md visible-lg">
          <div class="stats-header">
            <a  href="{{url('stats/')}}"><img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="100px" height="auto" style="padding-bottom:0; cursor: pointer;" onclick=""></a>
            <p style="color:white;font-size:20px;font-weight:bold;margin-bottom:0px;">ESTADÍSTICAS</p>
            <p style="color:white;font-size:12px;margin-top:0px;">EPSUM</p>
          </div>
          <div class="stats-menu">

            <a href="{{url('stats/students')}}" class="btn btn-primary stats-button" style="margin-top:200px;" > Estudiantes </a>
            <a href="{{url('stats/financing')}}" class="btn btn-primary stats-button" > Financiamiento </a>
            <a href="{{url('stats/teams')}}" class="btn btn-primary stats-button"> Equipos </a>
            <a href="{{url('stats/goodsservices')}}" class="btn btn-primary stats-button"> Bienes y Servicios <span class="label label-success">Nuevo</span></a>
           <!-- <a href="{{url('stats/diagnostics')}}" class="btn btn-primary stats-button"> Diagnósticos </a>-->
            <a href="{{url('stats/projects')}}" class="btn btn-primary stats-button"> Proyectos </a>
            <a href="{{url('request/getRequest')}}" class="btn btn-primary stats-button"> Solicitud de disciplinas </a>
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
        <div id="page-wrapper" style="background-color:white" >

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

            <p><strong>Estadísticas de EPSUM fue desarrollado por Carlos Paiz, de la Carrera de Ingeniería en Ciencias y Sistemas, del Centro Universitario de Oriente. Guatemala, 2018. La versión 2.0 de estadística fue desarrollado por Luis Felipe Dubón Obando, de la Carrera de Ingeniería en Ciencias y Sistemas, del Centro Universitario de Oriente. Guatemala, 2019. <br><br>"Id y enseñad a todos."</strong></p>
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
