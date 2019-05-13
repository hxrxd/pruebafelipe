<!DOCTYPE html>
<html class="loading">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/js/maperizer/style.css">
  <title>MiE | Geoportal</title>

  {!! Html::style('/css/bootstrap.min.css')!!}
  {!! Html::style('/font-awesome/css/font-awesome.css')!!}
  {!! Html::style('/css/animate.css')!!}
  {!! Html::style('/css/style.css')!!}

  <script src = "/js/jquery-2.1.1.js"></script>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <!-- getmdl -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-blue.min.css" />
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>

<body class="gray-bg">
  <div id="appbar">
    <img src="/img/logoepsum-2.png" alt="logo-epsum" width="48" height="32" style="cursor: pointer;" onclick="generalViewMap()">
    <a class="title-app">Geoportal</a>
    <i class="fa fa-search search-button" style="font-size:24px" onclick="showMenu()"></i>
  </div>
  <div id="map"></div>

  <div id="bottombar">
    <div class="title-stats">{{$cohort}}</div>
    <div class="stats">
      <div><span>{{$stats_hqs}}</span><p>Sedes</p></div>
      <div><span>{{$stats_students}}</span><p>Estudiantes</p></div>
      <div><span>{{$stats_teams}}</span><p>Equipos</p></div>
    </div>
  </div>

  <div id="snackbar"></div>

  <div id="welcome">
    <i class="material-icons closebtn" onclick="closeWelcomeMessage()">clear</i>
    <h3 id="wtitle">Bienvenido al Geoportal de EPSUM</h3>
    <p id="wmsg">Mira todas las sedes de EPSUM y consulta la información de los equipos distribuidos en todo el país.
    </br></br>Toca el ícono <i class="fa fa-search" style="font-size:10px; color:#1e1e1e"></i> para iniciar.</br></br>
    </p>
  </div>

  <div id="mySidenav" class="sidenav" onscroll="swipeUp()">
    <i class="material-icons closebtn" onclick="closeNav()">clear</i>
    <div>
      <!--<img src="https://drive.google.com/uc?export=view&id=1d85AWUAwkxOl6Nruu0gdD98TIuFV4lNO" alt="epsum" width="100%" height="auto">-->
      <h2 id="title" style="padding-bottom:0px; margin-bottom:5px">Team</h2>
      <p id="teamcohort" style="padding-top:0px;">none</p>
      <h3 id="nodata" style="padding-top:0px;"></h3>
      <button id="btn-dx" type="button" class="btn" onclick="showSnackbar('Opción en desarrollo.')">Diagnóstico</button>
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
        <h3 style="padding-top:0px; color:#f0f0f0"><i class="material-icons" style="font-size:48px">error_outline</i></br>Estamos trabajando en esta sección. Pronto podrás consultar los proyectos...</h3>
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

  <div id="search-pane">
    <div class="header-title">
      <div class="col-sm-12"/>
      <div class="pane-hide">
        <img src="/img/logoepsum-2.png" alt="logo-epsum" width="28%" height="13%" style="padding-bottom:0; cursor: pointer;" onclick="generalViewMap()">
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
            <div class="stats">
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
              </div>
          </div>
      </div>
    </div>
  </div>

<script>
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

$(window).bind('resize', function(e){
  console.log('window resized..');
  this.location.reload(false);
});

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
        icon: '/img/marker_blue.png',
        map: map
      });
    }else{
      var marker = new google.maps.Marker({
        position: {
          lat: Number(point.latitude),
          lng: Number(point.longitude)
        },
        animation: google.maps.Animation.DROP,
        icon: '/img/marker_red.png',
        map: map
      });
    }



    marker.addListener('click', function() {
      animateMapZoomTo(map, 15);
      map.setCenter(marker.getPosition());

      $.ajax({
        url: '/teams/name/'+point.team,
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
          test_func(point);
        }
      });

      document.getElementById("departament").selectedIndex = "1";
      $('select[name="departament"]').trigger("change");
      document.getElementById("departament").selectedIndex = "0";
      $("#teams option[value='"+point.team+"']").prop('selected', true);
      $('select[name="teams"]').parent().addClass('is-focused');
      openNav();

    });

  });

  function test_func(point){
    $.ajax({
      url: '/teams/location/'+point.team,
      type:"GET",
      dataType:"json",

      success:function(data) {
        $.each(data, function(key, value){
          $('#title').html(key + ", " + value);
        });
      },
    });

    $('#teamcohort').html("Equipo: " + current_team + " - " + current_cohort);

    $.get('/teams/info/'+point.team+'/'+current_cohort, function (data) {
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
        url: '/teams/get/'+depId,
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
      test_func(current);
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
        test_func(current);
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
  xobj.open('GET', '/js/maperizer/points.json', true);
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

</script>

<script src="/js/maperizer/map-functions.js"></script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtmXl7G4ovbk0nKslHhlmf45UNhBMJ2NM&callback=initMap&language=es&region=GT"
  onerror='alert("ERR_CONNECTION: No he ha establecido conexión. Asegúrese que se encuentra conectado a Internet.");'>
</script>

</body>
</html>
