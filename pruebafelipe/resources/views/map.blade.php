<!DOCTYPE html>
<html class="loading">
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119198157-1"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119198157-1');
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>MiE | Geoportal</title>

  {!! Html::style('/js/maperizer/style.css')!!}
  {!! Html::style('/css/bootstrap.min.css')!!}
  {!! Html::style('/font-awesome/css/font-awesome.css')!!}
  {!! Html::style('/css/animate.css')!!}
  {!! Html::style('/css/style.css')!!}
  {!! Html::style('css/plugins/sweetalert/sweetalert.css')!!}

  {!! HTML::script('js/jquery-2.1.1.js'); !!}
  {!! HTML::script('js/plugins/sweetalert/sweetalert.min.js') !!}

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <!-- getmdl -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-blue.min.css" />
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

  <style>
    html.loading {
      background: #fff url("{{asset('img/loading.gif')}}") no-repeat 50% 50%;
      -webkit-transition: background-color 0;
      transition: background-color 0;
    }
    body {
      -webkit-transition: opacity 1s ease-in;
      transition: opacity 1s ease-in;
    }
    html.loading body {
      opacity: 0;
      -webkit-transition: opacity 0;
      transition: opacity 0;
    }
  </style>

  <!-- Facebook Open Graph -->
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Geoportal de EPSUM - USAC"/>
    <meta property="og:description" content="¡Sigue el trabajo de los equipos multidisciplinarios y mira los proyectos que realizan por todo el país!"/>
    <meta property="og:image" content="{{asset('img/card-3.png')}}"/>

  <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="Geoportal de EPSUM - USAC"/>
    <meta name="twitter:description" content="¡Sigue el trabajo de los equipos multidisciplinarios y mira los proyectos que realizan por todo el país!"/>
    <meta name="twitter:image" content="{{asset('img/card-3.png')}}">

</head>

<body class="gray-bg">
  <div id="appbar">
    <img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="48" height="32" style="cursor: pointer;" onclick="generalViewMap()">
    <a class="title-app">Geoportal</a>
    <i class="fa fa-search search-button" style="font-size:24px" onclick="showMenu()"></i>
  </div>
  <div id="map"></div>

  <div id="bottombar">
    <div class="title-stats">{{substr($cohort,2,15)}}</div>
    <div class="stats">
      <div><span>{{$stats_teams}}</span><p style="font-size:10px;">Equipos</p></div>
      <div><span>{{$stats_hqs}}</span><p style="font-size:10px;">Sedes</p></div>
      <div><span>{{$stats_students}}</span><p style="font-size:10px;">Estudiantes</p></div>
    </div>
  </div>

  <div id="snackbar"></div>

  <div id="welcome">
    <i class="material-icons closebtn" onclick="closeWelcomeMessage()">clear</i>
    <h3 id="wtitle">Bienvenido al Geoportal de EPSUM</h3>
    <p id="wmsg">Mira todas las sedes de EPSUM y consulta la información de los equipos multidisciplinarios distribuidos en todo el país.
    </br></br>Toca el ícono <i class="fa fa-search" style="font-size:10px; color:#02556e"></i> para iniciar.</br></br>
    </p>
  </div>

  <div id="mySidenav" class="sidenav" onscroll="swipeUp()">
    <i class="material-icons closebtn" onclick="closeNav()">clear</i>
    <div>
      <!--<img src="https://drive.google.com/uc?export=view&id=1d85AWUAwkxOl6Nruu0gdD98TIuFV4lNO" alt="epsum" width="100%" height="auto">-->
      <h2 id="title" style="padding-bottom:0px; margin-bottom:5px">Team</h2>
      <p id="teamcohort" style="padding-top:0px;">none</p>
      <h3 id="nodata" style="padding-top:0px;"></h3>
      <button id="btn-dx" type="button" class="btn">Diagnóstico</button>
    </div>

    <div id="team-menu">
      <button class="accordion">Equipo</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <table id="list" class="table table-hover dataTables-example" >
          <thead>
            <tr>
              <th>Equipo</th>
              <th>Descripción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            </tr>
          </tbody>
        </table>
      </div>

      <button class="accordion">Proyectos</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <table id="projects" class="table table-hover dataTables-example" >
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Tipo</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            </tr>
          </tbody>
        </table>
        <h6 id="no-project" style="color:white; padding-right:15px; padding-left:25px;"></h6>
      </div>
    </div>
  </div>

  <div id="navDetail" class="nav-detail">
    <a href="javascript:void(0)" class="closebtn" onclick="hideDetail()"><i class="material-icons">arrow_back</i></a>
    <div >
      <h2 id="detail-title" style="padding-bottom:0px; margin-bottom:5px">Estudiante</h2>
    </div>
    <div >
      <h4>Datos Generales</h4>
      <label>Apellidos</label>
      <p id="surnames"></p>
      <label>Nombres</label>
      <p id="names"></p>
      <label>Lugar de origen</label>
      <p id="department"></p>
      <h4>Información Académica</h4>
      <label>Registro académico</label>
      <p id="carne"></p>
      <label>Carrera</label>
      <p id="career"></p>
      <label>Unidad Académica</label>
      <p id="academicu"></p>
      <h4>Datos de EPS</h4>
      <label>Tipo de práctica</label>
      <p id="practice"></p>
      <label>Cohorte</label>
      <p id="cohort"></p>
      <label>Equipo</label>
      <p id="team"></p>
      <label>Sede</label>
      <p id="headquarter"></p>
      <label>Fecha de inicio</label>
      <p id="initdate"></p>
      <label>Fecha de finalización</label>
      <p id="finishdate"></p>
      <label>Financiamiento</label>
      <p id="financing"></p>
      <label></label>
      <p></p>
    </div>
  </div>

  <div id="navDetailProject" class="nav-detail nav-detail-dx">
    <a href="javascript:void(0)" class="closebtn" onclick="hideDetailProject()"><i class="material-icons">arrow_back</i></a>
    <div >
      <h2 id="detail-title" style="padding-bottom:0px; margin-bottom:5px">Proyecto</h2>
    </div>
    <div style="margin-right:25px;">
      <h4>Datos Generales</h4>
      <label>Nombre del proyecto</label>
      <p id="name"></p>
      <label>Ubicación</label>
      <p id="location"></p>
      <label>Objetivo General</label>
      <p id="objective"></p>
      <label>Tipo de proyecto</label>
      <p id="type"></p>
      <label>Valor económico estimado</label>
      <p id="budget"></p>
      <h4>Ámbito de intervención</h4>
      <label>Línea</label>
      <p id="line"></p>
      <label>Área</label>
      <p id="area"></p>
      <label>Políticas asociadas</label>
      <p id="policy"></p>
      <h4>Tiempo y ejecución</h4>
      <label>Fecha de inicio</label>
      <p id="startdate"></p>
      <label>Fecha de finalización</label>
      <p id="deadline"></p>
      <label>Estado</label>
      <p id="status"></p>
      <h4>Actores</h4>
      <label>Partes involucradas</label>
      <p id="stakeholders"></p>
      <label></label>
      <p></p>
    </div>
  </div>

  <div id="navDetailDx" class="nav-detail nav-detail-dx">
    <a href="javascript:void(0)" class="closebtn" onclick="hideDetailDx()"><i class="material-icons">arrow_back</i></a>
    <div>
      <h2 id="detail-title" style="padding-bottom:0px; margin-bottom:5px">Diagnóstico<button id="btn-dw-dx" type="button" class="btn" style="float:right; margin-right:20px;">Descargar</button></h2>
      </br>
      <h6 id="no-dx" style="color:white; padding-right:15px; padding-left:25px;"></h6>
    </div>
    <div id="dx-pane">
      <button class="accordion">Introducción</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label></label>
        <p id="dx-intro" style="margin-right:25px;"></p>
        <label>Objetivo</label>
        <p id="dx-objective" style="margin-right:25px;"></p></br></br>
      </div>

      <button class="accordion">Territorio</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Lugar</label>
        <p id="dx-place" style="margin-right:25px;"></p>
        <label>Ubicación</label>
        <p id="dx-location" style="margin-right:25px;"></p>
        <label>MSNM (Metros sobre el nivel del mar)</label>
        <p id="dx-masl" style="margin-right:25px;"></p>
        <label>Superficie territorial</label>
        <p id="dx-surface" style="margin-right:25px;"></p></br></br>
      </div>
      <button class="accordion">Demografía</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Población de 0 a 14 años de edad</label>
        <p id="dx-p-0-14" style="margin-right:25px;"></p>
        <label>Población de 15 a 64 años de edad</label>
        <p id="dx-p-15-64" style="margin-right:25px;"></p>
        <label>Población de 65 años o más</label>
        <p id="dx-p-65-more" style="margin-right:25px;"></p>
        <label>Población de mujeres</label>
        <p id="dx-p-women" style="margin-right:25px;"></p>
        <label>Población hombres</label>
        <p id="dx-p-men" style="margin-right:25px;"></p>
        <label>Población rural</label>
        <p id="dx-p-rural" style="margin-right:25px;"></p>
        <label>Población urbana</label>
        <p id="dx-p-urban" style="margin-right:25px;"></p>
        <label>Población indígena</label>
        <p id="dx-p-indigenous" style="margin-right:25px;"></p>
        <label>Población garífuna</label>
        <p id="dx-p-garifuna" style="margin-right:25px;"></p>
        <label>Población Xinca</label>
        <p id="dx-p-xinca" style="margin-right:25px;"></p></br></br>
      </div>
      <button class="accordion">Economía</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Porcentaje de pobreza</label>
        <p id="dx-poverty" style="margin-right:25px;"></p>
        <label>Porcentaje de pobreza extrema</label>
        <p id="dx-poverty-extreme" style="margin-right:25px;"></p>
        <label>Total de ingreso por familia</label>
        <p id="dx-income-per-family" style="margin-right:25px;"></p>
        <label>Observaciones</label>
        <p id="dx-observations" style="margin-right:25px;"></p></br></br>
      </div>
      <button class="accordion">Salud</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Tasa de acceso a atención primaria en salud</label>
        <p id="dx-health-care" style="margin-right:25px;"></p>
        <label>Tasa de enfermedades vinculadas al consumo de agua no apta y mala disposición de excretas</label>
        <p id="dx-contaminated-water" style="margin-right:25px;"></p>
        <label>Tasa de desnutrición crónica en niños menores de 5 años</label>
        <p id="dx-chronic-malnutrition" style="margin-right:25px;"></p>
        <label>Enfermedades frecuentes en niños menores de 5 años</label>
        <p id="dx-diseases" style="margin-right:25px;"></p></br></br>
      </div>
      <button class="accordion">Educación</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Porcentaje de aprobación de prueba de matemática</label></br>
        <label>Nivel primario</label>
        <p id="dx-math-1" style="margin-right:25px;"></p>
        <label>Nivel secundario</label>
        <p id="dx-math-2" style="margin-right:25px;"></p>
        <label>Nivel diversificado</label>
        <p id="dx-math-3" style="margin-right:25px;"></p></br>
        <label>Porcentaje de aprobación de prueba de lectura</label></br>
        <label>Nivel primario</label>
        <p id="dx-read-1" style="margin-right:25px;"></p>
        <label>Nivel secundario</label>
        <p id="dx-read-2" style="margin-right:25px;"></p>
        <label>Nivel diversificado</label>
        <p id="dx-read-3" style="margin-right:25px;"></p></br></br>
      </div>
      <button class="accordion">Medio Ambiente</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Tasa de cobertura forestal</label>
        <p id="dx-forest-cover" style="margin-right:25px;"></p>
        <label>Número de planes de gestión integral de desechos sólidos</label>
        <p id="dx-plan" style="margin-right:25px;"></p>
        <label>Porcentaje de uso de la tierra para tareas agrícolas</label>
        <p id="dx-land-use" style="margin-right:25px;"></p></br></br>
      </div>
      <button class="accordion">Gestión Municipal</button>
      <div class="panel" style="background-color: transparent; margin-bottom: 0px;">
        <label>Índice de gestión municipal</label>
        <p id="dx-mm" style="margin-right:25px;"></p></br></br>
      </div>
    </div>
  </div>

  <div id="search-pane">
    <div class="header-title">
      <div class="col-sm-12"/>
      <div class="pane-hide">
        <img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="28%" height="13%" style="padding-bottom:0; cursor: pointer;" onclick="generalViewMap()">
        <a id="float-menu" type="button" class="btn btn-lg btn-circle btn-home" style="margin:50px;" onclick="fbOptions()"><i class="material-icons" style="margin-left:-4px; margin-top:2px;">menu</i></a>
        <a id="float-home" href="http://epsum.usac.edu.gt/" type="button" class="btn btn-lg btn-circle btn-options" style="display:none; margin:50px; margin-right:120px;"><i class="material-icons" style="margin-left:-4px; margin-top:2px;">home</i></a>
        <a id="float-ses" href="http://mieps.usac.edu.gt/public/login" type="button" class="btn btn-lg btn-circle btn-options" style="display:none; margin:50px; margin-right:185px;" onclick="showWelcomeMessage()"><i class="material-icons" style="margin-left:-4px; margin-top:2px;">account_circle</i></a>
        <a id="float-info" type="button" class="btn btn-lg btn-circle btn-options" style="display:none; margin:50px; margin-right:250px;" onclick="showWelcomeMessage()"><i class="material-icons" style="margin-left:-4px; margin-top:2px;">info</i></a>
        <h3 style="font-family: 'Titillium Web', sans-serif; font-size:28px">Geoportal <small>EPSUM</h3>
      </div>
    </div>

    <div id="detline">
      <div style="background-color:#02556e; height:12.5%;"></div>
      <div style="background-color:#95b1c2; height:12.5%;"></div>
      <div style="background-color:#2ebeef; height:12.5%;"></div>
      <div style="background-color:#abe1fa; height:12.5%;"></div>
      <div style="background-color:#a03522; height:12.5%;"></div>
      <div style="background-color:#d6acaa; height:12.5%;"></div>
      <div style="background-color:#f68628; height:12.5%;"></div>
      <div style="background-color:#fdcdab; height:12.5%;"></div>
    </div>

    <div class="ibox-content form-horizontal">
      {!! Form::open(['method'=>'POST']) !!}
      {{ csrf_field() }}
      <div class="dep mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <select id="cohort" name="cohort" class="mdl-textfield__input " >
          @foreach ($gcohorts as $cohort => $value)
            <option value="{{ $cohort }}" selected> {{ $value }}</option>
          @endforeach
        </select>
        <label class="mdl-textfield__label" for="cohort">Cohorte</label>
      </div>

      <div class="dep mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-color--red-100{background-color:#ffcdd2">
        <select id="departament" name="departament" class="mdl-textfield__input" onclick="closeNav()">
          <option></option>
          <option value="ALL_DEPTS">Todos los departamentos</option>
          @foreach ($departaments as $department => $value)
            <option value="{{ $department }}"> {{ $value }}</option>
          @endforeach
        </select>
        <label class="mdl-textfield__label" for="departament">Departamento</label>
      </div>

      <div class="teams-div mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <select id="teams" name="teams" class="mdl-textfield__input">
          <option></option>
          @foreach ($teams as $team => $value)
            <option value="{{ $team }}"> {{ $value }}</option>
          @endforeach
        </select>
        <label class="mdl-textfield__label" for="teams">Equipo</label>
      </div>

      {!! Form::close() !!}

      <div class="pane-hide">
        <div class="hr-line-dashed"></div>
          <div class="dep form-group">
            <div class="col-sm-12">
              <h5>Resumen General</h5>
            </div>
          </div>

          <div class="form-group">
            <table id="sumary" class="table table-hover" style="margin-bottom:24px;">
              <thead>
                <tr></tr>
              </thead>
              <tbody>
                  <tr>
                    <td><span style="color:#1e4f4f;font-size:24px;marging-top:0px">{{$stats_students}}</span></td>
                    <td><span style="color:#49baba;font-size:24px;marging-top:0px">{{$stats_teams}}</span></td>
                    <td><span style="color:#990000;font-size:24px;marging-top:0px">{{$stats_hqs}}</span></td>
                  </tr>
                  <tr>
                    <td style="padding-bottom:8px;">Estudiantes</td>
                    <td style="padding-bottom:8px;">Equipos</td>
                    <td style="padding-bottom:8px;">Sedes</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{url('stats/')}}" type="button" style="color:white;font-size:18px;font-weight:bold;"><div style="margin:auto;padding:10px;background-color:#f68628;color:white;font-size:16px;border-radius:4px;text-align:center">
                Ver estadísticas completas
              </div></a>
              </br>
              <a href="{{url('request/getRequest')}}" type="button" style="color:white;font-size:18px;font-weight:bold;"><div style="margin:auto;padding:10px;background-color:#2ebeef;color:white;font-size:16px;border-radius:4px;text-align:center">
                Solicitud de disciplinas
              </div></a>
            <!--<div class="stats">
              <table id="sumary" class="table table-hover dataTables-example" >
                <thead>
                  <tr></tr>
                </thead>
                <tbody>
                  <tr>
                    <td><span style="color:#1e4f4f;font-size:24px;marging-top:0px">{{$stats_students}}</span></td>
                      <td>Estudiantes</td>
                    </tr>
                    <tr>
                      <td><span style="color:#49baba;font-size:24px;marging-top:0px">{{$stats_teams}}</span></td>
                      <td>Equipos</td>
                    </tr>
                    <tr>
                      <td><span style="color:#990000;font-size:24px;marging-top:0px">{{$stats_hqs}}</span></td>
                      <td>Sedes</td>
                    </tr>
                  </tbody>
                </table>
              </div>-->
          </div>
      </div>
    </div>
  </div>

<script>
var float_status = false;
var infowindow;
var current_cohort = $('select[name="cohort"] option:selected').text();
var current_team;
var coords = {
  lat: 15.106724,
  lng: -90.627633
};
var map;

var html = document.getElementsByTagName('html')[0];
var interval = setInterval(function() {
  if(document.readyState === 'complete'){
    clearInterval(interval);
    console.log('DONE!');
    html.className = html.className.replace(/loading/, '');
    $('.stats span').each(function () {
      $(this).prop('Counter',0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
          $(this).text(Math.ceil(now));
        }
      });
    });
  }
}, 100);

/*$(window).bind('resize', function(e){
  console.log('window resized..');
  this.location.reload(false);
});*/

function fbOptions(){
  if(float_status == false){
    document.getElementById("float-home").style.display = "block";
    document.getElementById("float-info").style.display = "block";
    document.getElementById("float-ses").style.display = "block";

    float_status = true;
    setTimeout(function(){
      document.getElementById("float-home").style.opacity = "1";
      document.getElementById("float-info").style.opacity = "1";
      document.getElementById("float-ses").style.opacity = "1";
    },10);
  }else{
    document.getElementById("float-home").style.opacity = "0";
    document.getElementById("float-info").style.opacity = "0";
    document.getElementById("float-ses").style.opacity = "0";

    setTimeout(function(){
      document.getElementById("float-home").style.display = "none";
      document.getElementById("float-info").style.display = "none";
      document.getElementById("float-ses").style.display = "none";
      float_status = false;
    }, 1000);
  }

}

function closeInfoWindow(){
  if(infowindow !=null){
    infowindow.close();
  }
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
  zoom: 9,
  center: coords,
  styles: [
          {
            "stylers": [
              {
                "saturation": -100
              },
              {
                "gamma": 1
              }
            ]
          },
          {
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.business",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.business",
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.place_of_worship",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "administrative.province",
            "elementType": "geometry",
            "stylers": [
              {
                "weight": "2.00"
              },
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "poi.place_of_worship",
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "water",
            "stylers": [
              {
                "visibility": "on"
              },
              {
                "saturation": 50
              },
              {
                "gamma": 0
              },
              {
                "hue": "#50a5d1"
              }
            ]
          },
          {
            "featureType": "administrative.neighborhood",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#333333"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "labels.text",
            "stylers": [
              {
                "weight": 0.5
              },
              {
                "color": "#333333"
              }
            ]
          },
          {
            "featureType": "transit.station",
            "elementType": "labels.icon",
            "stylers": [
              {
                "gamma": 1
              },
              {
                "saturation": 50
              }
            ]
          }
        ]
  });

  var c = {!! json_encode($coordinates->toArray()) !!};

  c.forEach(function(point){
    if(point.team == 130){
      var marker = new google.maps.Marker({
        position: {
          lat: Number(point.latitude),
          lng: Number(point.longitude)
        },
        animation: google.maps.Animation.DROP,
        icon: '{{asset("img/marker_blue.png")}}',
        map: map
      });
    }else{
      var marker = new google.maps.Marker({
        position: {
          lat: Number(point.latitude),
          lng: Number(point.longitude)
        },
        animation: google.maps.Animation.DROP,
        icon: '{{asset("img/marker_red.png")}}',
        map: map
      });
    }

    marker.addListener('click', function() {
      animateMapZoomTo(map, 15);
      map.setCenter(marker.getPosition());

      $.ajax({
        url: '{{asset("teams/name/point")}}'.replace('point',point.team),
        type:"GET",
        dataType:"json",

        success:function(data) {
          var contentString;
          $.each(data, function(key, value){
            contentString = '<div><p style="padding-bottom:0px; margin: 0px">Equipo: <strong>'+value.name+'</strong></p></div>';
            console.log("NAME_TEAM: "+value.name);
            current_team = value.name;
          });

          closeInfoWindow();

          infowindow = new google.maps.InfoWindow({
            content: contentString
          });

          infowindow.open(map, marker);

          loadData(point);
        }
      });

      document.getElementById("departament").selectedIndex = "1";
      $('select[name="departament"]').trigger("change");
      document.getElementById("departament").selectedIndex = "0";
      $("#teams option[value='"+point.team+"']").prop('selected', true);
      $('select[name="teams"]').parent().addClass('is-focused');

      openNav();
      //document.getElementById("mySidenav").contentWindow.location.reload(true);
    });

  });

  function loadData(point){
    $.ajax({
      url: '{{asset("teams/location/point")}}'.replace('point',point.team),
      type:"GET",
      dataType:"json",

      success:function(data) {
        $.each(data, function(key, value){
          $('#title').html(key + ", " + value);
        });
      },
    });

    $('#teamcohort').html("Equipo: " + current_team + " - " + current_cohort);

    $.get('{{asset("teams/info/point/cohort")}}'.replace('point/cohort',point.team+'/'+current_cohort), function (data) {
      //success data
      console.log(data);
      $('table[id="list"]').empty();
      $('#nodata').html("");
      if(data.length == 0){
        $('#nodata').html('<i class="material-icons" style="font-size:36px;">remove_circle_outline</i></br>'+"No se encontraron resultados para esta cohorte.");
        $('#btn-dx').hide();
        $('#team-menu').hide();
      }else{
        $('#btn-dx').show();
        $('#team-menu').show();
        $('table[id="list"]').append('<thead><tr><th>Estudiante</th><th>Carrera</th></tr></thead>');
        $('table[id="list"]').append('<tbody>');

        data.forEach(function(item){
          $('table[id="list"]').append('<tr onclick="showDetail('+item.id_student+')"><td style="min-width:180px;">' + item.name + ' '+ item.fsurname + '</td><td>' + item.career + '</td></tr>');
        });
        $('table[id="list"]').append('</tbody>');
      }
    });

    $.get('{{asset("teams/projects/id/cohort")}}'.replace('id/cohort',point.team+'/'+current_cohort), function (data) {
      //success data
      console.log(data);
      $('table[id="projects"]').empty();
      $('#no-project').html("");
      if(data.length == 0){
        $('#no-project').html("Aún no hay proyectos asociados a este equipo en la cohorte seleccionada. Intenta buscando para otra cohorte.");
      }else{
        $('table[id="projects"]').append('<thead><tr><th>Nombre</th><th>Tipo</th></tr></thead>');
        $('table[id="projects"]').append('<tbody>');

        data.forEach(function(pj){
          $('table[id="projects"]').append('<tr onclick="showDetailProject('+pj.id+')"><td style="min-width:180px;">' + pj.name + '</td><td>' + pj.type + '</td></tr>');
        });
        $('table[id="projects"]').append('</tbody>');
      }
    });

    $('#btn-dx').click(function(){

      $.get('{{asset("teams/dx/id/cohort")}}'.replace('id/cohort',point.team+'/'+current_cohort.substring(1,15)), function (data) {
        //success data
        console.log('DATA_TOTAL'+data.length);
        showDetailDx();
        if(data.length == 0){
            $('#btn-dw-dx').hide();
            $('#no-dx').show();
            $('#no-dx').html("Aún no hay un diagnóstico asociado a este lugar en la cohorte seleccionada. Intenta buscando para otra cohorte.");
            $('#dx-pane').hide();
            //showSnackbar('Aún no hay un diagnóstico asociados a este equipo en la cohorte seleccionada. Intenta buscando para otra cohorte.');
        }else{
          data.forEach(function(dx){

            $('#no-dx').hide();
            $('#dx-pane').show();
            $('#dx-intro').html(dx.introduction);
            $('#dx-objective').html(dx.objective);
            $('#dx-place').html(dx.name);
            $('#dx-location').html(dx.location);
            $('#dx-masl').html(dx.masl + 'm');
            $('#dx-surface').html(dx.surface + 'km&sup2;');
            $('#dx-p-0-14').html(dx.population_0_to_14 + ' personas');
            $('#dx-p-15-64').html(dx.population_15_to_64 + ' personas');
            $('#dx-p-65-more').html(dx.population_65_or_more + ' personas');
            $('#dx-p-women').html(dx.population_women);
            $('#dx-p-men').html(dx.population_men);
            $('#dx-p-rural').html(dx.population_rural + ' habitantes');
            $('#dx-p-urban').html(dx.population_urban + ' habitantes');
            $('#dx-p-indigenous').html(dx.population_indigenous + ' habitantes');
            $('#dx-p-xinca').html(dx.population_garifuna + ' habitantes');
            $('#dx-p-garifuna').html(dx.population_garifuna + ' habitantes');
            $('#dx-poverty').html(dx.poverty + '%');
            $('#dx-poverty-extreme').html(dx.poverty_extreme + '%');
            $('#dx-income-per-family').html('Q '+dx.income_per_family);
            $('#dx-observations').html(dx.observations + ' -');
            $('#dx-health-care').html(dx.rate_access_primary_health_care + '%');
            $('#dx-contaminated-water').html(dx.rate_diseases_by_contaminated_water + '%');
            $('#dx-chronic-malnutrition').html(dx.rate_chronic_malnutrition + '%');
            $('#dx-diseases').html(dx.diseases);
            $('#dx-math-1').html(dx.percentage_math_test_approval_primary + '%');
            $('#dx-math-2').html(dx.percentage_math_test_approval_secondary +'%');
            $('#dx-math-3').html(dx.percentage_math_test_approval_diversified +'%');
            $('#dx-read-1').html(dx.percentage_reading_test_approval_primary +'%');
            $('#dx-read-2').html(dx.percentage_reading_test_approval_secondary + '%');
            $('#dx-read-3').html(dx.percentage_reading_test_approval_diversified +'%');
            $('#dx-forest-cover').html(dx.forest_cover_rate + '%');
            $('#dx-plan').html(dx.num_plans_integral_management_solid_waste);
            $('#dx-land-use').html(dx.land_use_rate +'%');
            $('#dx-mm').html(dx.municipal_management_index);

            $('#no-dx').html('');
            $('#btn-dw-dx').show();
          });

        }
      });
    });



    $('#btn-dw-dx').click(function(){
      /*$.ajax('{{asset("teams/download/dx/id/cohort")}}'.replace('id/cohort',point.team+'/'+current_cohort.substring(1,15)),function(data){
        alert("DOWNLOAD!");
      });*/
      location.href = '{{asset("teams/download/dx/id/cohort")}}'.replace('id/cohort',point.team+'/'+current_cohort.substring(1,15));
      swal({
          title: "Se ha descargado el diagnóstico",
          text: "La información fue descargada como documento PDF",
          confirmButtonColor: "#2ebeef"
      });
    });
  }

  $('select[name="departament"]').on('change', function(e){
    var depId = $(this).val();

    if(depId != 'ALL_DEPTS') {
      loadJSON(function(response) {
        var str = $('select[name="departament"] option:selected').text();
        var current_depto = str.substring(1,str.length);
        var data = JSON.parse(response);
        console.log(data[current_depto].name);
        console.log(data[current_depto].lat);
        console.log(data[current_depto].long);

        animateMapZoomTo(map, 12);
        map.panTo(new google.maps.LatLng(data[current_depto].lat, data[current_depto].long));
      });

      $.ajax({
        url: '{{asset("teams/get/id")}}'.replace('id',depId),
        type:"GET",
        dataType:"json",

        success:function(data) {
          $('select[name="teams"]').empty();
          $('select[name="teams"]').append('<option></option>');
          $.each(data, function(key, value){
            console.log('key: '+key+' val: '+value);
            $('select[name="teams"]').append('<option value="'+ key +'">' + value + '</option>');
          });
        },
      });
    } else {
      $('select[name="teams"]').empty();
      $('select[name="teams"]').append('<option></option>');
      var tm = {!! json_encode($teams->toArray()) !!};
      $.each(tm, function(key, value){
        $('select[name="teams"]').append('<option value="'+ key +'">' + value + '</option>');
      });
    }

    $('select[name="departament"]').blur();
  });

  $('select[name="teams"]').on('change', function(){
    var team_id = $(this).val();
    current_team = $('select[name="teams"] option:selected').text();

    function CallbackFunctionToFindTeamById(t) {
      return t.team == team_id;
    }

    current = c.find(CallbackFunctionToFindTeamById);

    if(current != null){
      animateMapZoomTo(map, 15);
      map.panTo(new google.maps.LatLng(current.latitude, current.longitude));
      loadData(current);
      openNav();
    }else{
      console.log("NO_DATA");
    }
    $('select[name="teams"]').blur();
  });


  $('select[name="cohort"]').on('change', function(){
    var team_id = $('select[name="teams"]').val();
    current_cohort = $('select[name="cohort"] option:selected').text();

    if(team_id != null){
      function CallbackFunctionToFindTeamById(t) {
        return t.team == team_id;
      }

      var current = c.find(CallbackFunctionToFindTeamById);
      if(current != null){
        loadData(current);
        openNav();
      }
    }
    $('select[name="cohort"]').blur();
  });

}

function generalViewMap(){
  closeNav();
  animateMapZoomTo(map, 8);
  map.panTo(new google.maps.LatLng(coords.lat,coords.lng));
}

function loadJSON(callback) {
  var xobj = new XMLHttpRequest();
  xobj.overrideMimeType("application/json");
  xobj.open('GET', '{{asset("js/maperizer/points.json")}}', true);
  xobj.onreadystatechange = function () {
    if (xobj.readyState == 4 && xobj.status == "200") {
      callback(xobj.responseText);
    }
  };
  xobj.send(null);
}

function show(){
  loadJSON(function(response) {
    var actual_JSON = JSON.parse(response);
    console.log(actual_JSON);
  });
}

function animateMapZoomTo(map, targetZoom) {
  var currentZoom = arguments[2] || map.getZoom();
  if (currentZoom != targetZoom) {
    google.maps.event.addListenerOnce(map, 'zoom_changed', function (event) {
      animateMapZoomTo(map, targetZoom, currentZoom + (targetZoom > currentZoom ? 1 : -1));
    });
    setTimeout(function(){ map.setZoom(currentZoom) }, 50);
  }
}

function reload(){
    var container = document.getElementById("mySidenav");
    var content = container.innerHTML;
    container.innerHTML= content;
}

//MAP FUNCTIONS
var status = 0;
var welcome_msg_status = 1;
var nav_status = 0;
var acc = document.getElementsByClassName("accordion");
var i;
var minh = "700px"

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    panel.style.backgroundColor = "transparent";

    if(panel.style.maxHeight){
      this.style.backgroundColor = "transparent";
      panel.style.maxHeight = null;
    }else{

      this.style.backgroundColor = "#2ebeef";
      panel.style.maxHeight = panel.scrollHeight + "px";
    }


  });
}

//init welcome message for desktop

if($(window).width() >= 768){
  document.getElementById("wmsg").innerHTML = "Mira todas las sedes de EPSUM y consulta la información de los equipos distribuidos en todo el país. Accede a información pública como diagnósticos comunitarios e informes de los proyectos realizados.</br></br>En el panel de la izquierda, selecciona una cohorte, el lugar y el equipo que quieras ver. ¡También puedes desplazarte por el mapa y seleccionar cualquier marcador!"
  document.getElementById("wtitle").style.fontFamily = "'Titillium Web', sans-serif";
  document.getElementById("wtitle").style.fontSize = "36px";
  document.getElementById("wtitle").style.Color = "#02556e";
  document.getElementById("wtitle").style.paddingTop = "80px";
}

function openNav() {
  if($(window).width() >= 768){

    if(welcome_msg_status == 1){
      closeWelcomeMessage();
    }

    document.getElementById("mySidenav").style.width = "30%";
    document.getElementById("map").style.marginLeft = "55%";
    document.getElementById("map").style.width = "45%";
  }else if($(window).width() > 319 && $(window).width() < 768){
    status = 0;

    if(welcome_msg_status == 1){
      closeWelcomeMessage();
    }

    document.getElementById("search-pane").style.height = "0";
    document.getElementById("mySidenav").style.height = "60%";
    document.getElementById("map").style.marginTop = "71px";
    document.getElementById("map").style.height = "30%";
    document.getElementById("bottombar").style.height = "0";
  }
}

function closeNav() {
  if($(window).width() >= 768){
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("map").style.marginLeft= "25%";
    document.getElementById("map").style.width = "75%";
  }else if($(window).width() > 319 && $(window).width() < 768){
    if(status == 0){
      document.getElementById("mySidenav").style.height = "0";
      document.getElementById("map").style.height = "65%";
      document.getElementById("bottombar").style.height = "25%";
    }
  }
}

function showDetail(id){
  $.get('{{asset("teams/student/id")}}'.replace("id",id), function (data) {
    $('#surnames').html(data[0].fsurname + ' ' + data[0].ssurname);
    $('#names').html(data[0].name);
    $('#department').html(data[0].municipality + ', ' + data[0].departament);
    //$('#municipality').html(data[0].municipality);
    $('#carne').html(data[0].carne);
    $('#career').html(data[0].career);
    $('#academicu').html(data[0].academicu);
    $('#practice').html(data[0].practice);
    $('#cohort').html(data[0].cohort);
    $('#team').html(data[0].team);
    $('#headquarter').html(data[0].headquarter);
    $('#initdate').html(data[0].initd);
    $('#finishdate').html(data[0].endd);
    $('#financing').html(data[0].financing);
  });

  if($(window).width() >= 768){
    document.getElementById("navDetail").style.width = "30%";
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("navDetail").style.height = "90%";
  }

  status = 2;
}

function showDetailProject(id){
  $.get('{{asset("teams/pj/id")}}'.replace("id",id), function (data) {

    $('#name').html(data.pjname);
    $('#location').html(data.location);
    $('#objective').html(data.objective);
    //$('#municipality').html(data[0].municipality);
    $('#type').html(data.type);
    $('#budget').html('Q.' + data.budget);
    $('#line').html(data.linename);
    $('#area').html(data.area);
    $('#policy').html(data.policy);
    $('#startdate').html(data.startdate);
    $('#deadline').html(data.deadline);

    if(data.edit_flag != 100){
        $('#status').html("En ejecución");
    }else{
        $('#status').html("Finalizado");
    }

    $('#stakeholders').html(data.stakeholders);
  });

  if($(window).width() >= 768){
    document.getElementById("navDetailProject").style.width = "30%";
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("navDetailProject").style.height = "90%";
  }

  status = 2;
}

function showDetailDx(){


  if($(window).width() >= 768){
    document.getElementById("navDetailDx").style.width = "30%";
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("navDetailDx").style.height = "90%";
  }

  status = 2;
}

function resetDxDetail(){
  $('#dx-intro').html();
  $('#dx-objective').html();
  $('#dx-place').html();
  $('#dx-location').html();
  $('#dx-masl').html();
  $('#dx-surface').html();
  $('#dx-p-0-14').html();
  $('#dx-p-15-64').html();
  $('#dx-p-65-more').html();
  $('#dx-p-women').html();
  $('#dx-p-men').html();
  $('#dx-p-rural').html();
  $('#dx-p-urban').html();
  $('#dx-p-indigenous').html();
  $('#dx-p-xinca').html();
  $('#dx-p-garifuna').html();
  $('#dx-poverty').html();
  $('#dx-poverty-extreme').html();
  $('#dx-income-per-family').html();
  $('#dx-observations').html();
  $('#dx-health-care').html();
  $('#dx-contaminated-water').html();
  $('#dx-chronic-malnutrition').html();
  $('#dx-diseases').html();
  $('#dx-math-1').html();
  $('#dx-math-2').html();
  $('#dx-math-3').html();
  $('#dx-read-1').html();
  $('#dx-read-2').html();
  $('#dx-read-3').html();
  $('#dx-forest-cover').html();
  $('#dx-plan').html();
  $('#dx-land-use').html();
  $('#dx-mm').html();
}

function hideDetail(){
  if($(window).width() >= 768){
    document.getElementById("navDetail").style.width = "0";
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("navDetail").style.height = "0";
    status = 0;
  }
}

function hideDetailProject(){
  if($(window).width() >= 768){
    document.getElementById("navDetailProject").style.width = "0";
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("navDetailProject").style.height = "0";
    status = 0;
  }
}

function hideDetailDx(){
  resetDxDetail();
  if($(window).width() >= 768){
    document.getElementById("navDetailDx").style.width = "0";
    document.getElementById("navDetailDx").contentWindow.location.reload(true);
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("navDetailDx").style.height = "0";
    status = 0;
  }
}

/* for mobile */

function showMenu() {
  closeNav();

  if(welcome_msg_status == 1){
    closeWelcomeMessage();
  }

  if(status == 0){
    document.getElementById("search-pane").style.height = "45%";
    document.getElementById("map").style.marginTop = "80%";
    document.getElementById("map").style.height = "60%";
    document.getElementById("bottombar").style.height = "0";
    status = 1;
  }else if(status == 2){
    hideDetail();
  }else{
    document.getElementById("search-pane").style.height = "0";
    document.getElementById("map").style.marginTop = "71px";
    document.getElementById("map").style.height = "65%";
    document.getElementById("bottombar").style.height = "25%";
    status = 0;
  }
}

function swipeUp() {
  if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("mySidenav").style.height = "90%";
    document.getElementById("map").style.marginTop = "71px";
    document.getElementById("map").style.height = "0";
  }
}

function showSnackbar(message) {
  document.getElementById("snackbar").innerHTML = message;
  document.getElementById("snackbar").style.height = "56px";
  document.getElementById("snackbar").style.verticalAlign = "middle";
  document.getElementById("snackbar").style.lineHeight = "56px";
  setTimeout(function(){
    document.getElementById("snackbar").style.height = "0";
  }, 3000);
}

function closeWelcomeMessage(){
  if($(window).width() >= 768){
    document.getElementById("welcome").style.opacity = "0";
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("welcome").style.bottom = "-52%";
  }
  setTimeout(function(){
    document.getElementById("welcome").style.display = "none";
    welcome_msg_status = 0;
  }, 1000);
}

function showWelcomeMessage(){
  if($(window).width() >= 768){

    document.getElementById("welcome").style.opacity = "1";
    document.getElementById("welcome").style.display = "block";
    $("#wtitle").html("Geoportal de Programa EPSUM");

    document.getElementById("wmsg").style.lineHeight ="18px";
    $("#wmsg").html("Geoportal de EPSUM es una aplicación para la consulta de información del Programa, generada por los equipos multidisciplinarios en áreas de pobreza y pobreza extrema en todo el país.</br></br>El proyecto ha sido realizado por el estudiante <strong>Carlos Orlando Paiz Raymundo</strong> como parte de las actividades del Ejercicio Profesional Supervisado de la carrera de <strong>Ingeniería en Ciencias y Sistemas, Centro Universitario de Oriente CUNORI</strong>.</br></br>Guatemala, mayo de 2018.");
  }else if($(window).width() > 319 && $(window).width() < 768){
    document.getElementById("welcome").style.bottom = "0%";
  }

  welcome_msg_status = 1;

}

</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtmXl7G4ovbk0nKslHhlmf45UNhBMJ2NM&callback=initMap&language=es&region=GT"
  onerror='alert("ERR_CONNECTION: No se ha establecido conexión. Asegúrese que se encuentra conectado a Internet.");'>
</script>



</body>
</html>
