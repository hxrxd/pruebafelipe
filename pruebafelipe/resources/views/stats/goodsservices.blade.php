@extends('statstemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Indicadores de beneficios sobre el territorio Nacional</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>

        <div class="form-horizontal container-fluid">
      <form id="selectRE">
      <div class="row-fluid">
      <div class="form-group row ">
        <div class="col-sm-4">
            <label for="ex1">Año</label>
            <select class="js-example-basic-single" id="sel3" name="state" style="width:100%">
                <option selected>Seleccione ...</option>
                <option value="">2018</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label for="ex2">Demarcación Administrativa</label>
            <select class="js-example-basic-single" id="sel2" name="state" style="width:100%">
                <option selected>Seleccione ...</option>
                <option value="">Departamentos</option>
                <option value="">Municipalidades</option>
                <option value="">Nacional</option>
            </select>
        </div>
        <div class="col-sm-4">
        <label for="sel1">Lista de tipos de Indicadores:</label>
          <select class="form-control js-example-basic-single" id="sel1" name='state' style="width:100%">
            <option selected>Seleccione ...</option>
            <option value="">Consultas médicas</option>
            <option value="">Jornadas de vacunación</option>
            <option value="">Huertos familiares</option>
            <option value="">Jornadas de limpieza</option>
            <option value="">Políticas municipales</option>
            <option value="">Diseño de planos</option>
            <option value="">Talleres de capacitación</option>
            <option value="">Manuales</option>
            <option value="">Planes</option>
            <option value="">Guías metodológicas</option>
            <option value="">Huertos escolares</option>
            <option value="">Huertos comunales</option>
            <option value="">Invernaderos</option>
            <option value="">Consultas dentales</option>
            <option value="">Tratamiento de caries</option>
            <option value="">Extracción de piezas dentales</option>
            <option value="">Jornadas de reforestación</option>
            <option value="">Hectáreas reforestadas</option>
            <option value="">Personas capacitadas</option>
            <option value="">Basureros clandestinos erradicados</option>
            <option value="">Jornadas de deschatarrización</option>
            <option value="">Jornadas de reciclaje</option>
            <option value="">Proceso de crianza de animales de granja</option>
            <option value="">Jornadas</option>
            <option value="">Diagnóstico</option>
            <option value="">Ferias</option>
            <option value="">Indicadores por Demarcación Administrativa</option>
          </select>
        </div>
       </div>
        <div class="span6">
        <div class="form-group ">
        
          <div id="yearN" >
              <br>
              <h3>Periodo de conglomeración de datos</h3>
           <!-- <label class="radio-inline"><input type="radio" name="optradio"  class="option-input radio"checked>Mensual</label>
            <label class="radio-inline"><input type="radio" name="optradio" class="option-input radio">Cuatrimestre</label>-->
            <div class="cntr" style="align-items: center;">
                <label for="rdo-1" class="btn-radio">
                <input type="radio" id="rdo-1" name="radio-grp">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="9"></circle>
                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                </svg>
                <span>Mensual</span>
                </label>
                <label for="rdo-2" class="btn-radio">
                <input type="radio" id="rdo-2" name="radio-grp">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="9"></circle>
                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                </svg>
                <span>Cuatrimestre</span>
                </label>
            </div>
          </div>
          <div class="input-group-append">
              
            <button id="btnS" class="btn btn-primary" type="button" style="margin: 20px">Seleccionar</button>
          </div>
        </div>
        </div></div>
      </form>
</div>
<div id="rSe">
    <select class="js-example-basic-multiple" name="states[]" multiple="multiple" style="width:100%">
    <option value="AL">Petén</option>
    <option value="AL">Alta Verapaz</option>
    <option value="WY">Izabal</option>
    <option value="WY">Baja Verapaz</option>
    <option value="WY">Quiche</option>
    <option value="WY">Chiquimula</option>
    </select>
</div>
</div>
  <div style="display:none" id="loader-modal"></div>


@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://codepen.io/anon/pen/aWapBE.js"></script>
<script type="text/javascript">
    var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };
  function resizePadding() {
    if(isMobile.any()) {
      jQuery("#frame").css("padding", "5px")
    }else{
      jQuery("#frame").css("padding", "60px")
    }
  }

  var languageData = '{"processing":"Cargando datos...","search": "Buscar","lengthMenu": "Mostrar _MENU_ datos","info": "Numero de páginas mostradas _PAGE_ of _PAGES_","infoEmpty":"No se encuentra datos disponibles","infoFiltered":"(Filtrado por _MAX_ total de datos)","loadingRecords": "Cargando datos...","zeroRecords":"No se encuentra información - Lo sentimos","emptyTable":"No se encuentra datos disponibles","paginate": {"first":"Primera","previous":"Anterior","next":"Siguiente","last":"Última"}}';
  var objLanguage = JSON.parse(languageData);

  function testSelect(e){
    e.preventDefault();
    jQuery('#rSe').show();
  }
  jQuery(document).ready(function() {
    resizePadding();
    jQuery('.js-example-basic-single').select2();
    jQuery('.js-example-basic-multiple').select2();
    jQuery('#rSe').hide();
    jQuery('#btnS').click(testSelect);
  });

  jQuery(window).resize(function(){
    resizePadding();
   });
  $(window).on('load',function(){
      //$('#myModal').modal('show');
  });

  var gamma = [ '#004455', '#2c89a0', '#69d2e7', '#aaccff', '#e0e4cc',
                '#ffb380', '#fa6900', '#ffcc00', '#ffe680', '#e9ddaf',
                '#ddff55', '#668000'];
  var blue_array = [ '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7'];

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');
    }
  }, 500);

</script>

<style>

  h1{
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 0px;
    padding-bottom: opx;
  }
  h2{
    color: #02556e;
    margin-top:35px;
    text-transform: uppercase;
    text-align: center;
  }
  h3{
    text-align: center;
    text-transform: uppercase;
    margin-top:0px;
    margin-bottom: 18px;
  }
  h4{
    text-align: center;
    color: #f68628;
    font-size: 18px;
    font-weight: normal;
    text-transform: uppercase;
    margin-top:0px;
    margin-bottom: 18px;
  }
  h5{
    text-align: left;
    color: #2ebeef;
    font-size: 16px;
    font-weight: normal;
    margin-top:0px;
  }
  p{
    text-align : justify;
  }

  tr:nth-child(even){
    background-color: #f5f5dc;
  }
  th, td {
    text-align: left;
    padding-right: 15px;
    padding-left: 15px;
  }
  .contenido{
    font-size: 20px;
  }
  .frame{
    padding: 40px;
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    font-size: 12px;
  }

  .subtitle{
    font-weight: bold;
    font-size: 14px;
  }
  .logos{
    width: 60%;
    margin: 0 auto;
  }

  .numbers{
    text-align: left;
    font-weight: bold;
    font-size: 24px;
    margin-bottom: 0px;
    padding-bottom: 5px;
    padding-bottom: 7px;
  }

  .color-indico{
    color:white;
    background-color: #02556e;
  }

  .color-indico-2{
    font-weight: bold;
    color:white;
    background-color: #95b1c2;
  }
  .color-blue{
    color:white;
    background-color: #2ebeef;
  }
  .color-blue-2{
    font-weight: bold;
    color:white;
    background-color: #abe1fa;
  }
  .color-red{
    color:white;
    background-color: #a03522;
  }
  .color-red-2{
    font-weight: bold;
    color:white;
    background-color: #d6acaa;
  }
  .color-orange{
    color:white;
    background-color: #f68628;
  }
  .color-orange-2{
    font-weight: bold;
    color:white;
    background-color: #fdcdab;
  }

  #segundo{
    color:#44a359;
  }
  #tercero{
    text-decoration:line-through;
  }

  .custom-legend {
    position: absolute;
    top: 130%;
    left: 53%;

    margin-bottom: 0px;
    font-size: 16px;
    min-width: 75px;
  }


  /*for radio buttons*/
.cntr {
  margin: auto;
}

.btn-radio {
  cursor: pointer;
  display: inline-block;
  float: center;
  -webkit-user-select: none;
  user-select: none;
}
.btn-radio:not(:first-child) {
  margin-left: 20px;
}
@media screen and (max-width: 480px) {
  .btn-radio {
    display: block;
    float: none;
  }
  .btn-radio:not(:first-child) {
    margin-left: 0;
    margin-top: 15px;
  }
}
.btn-radio svg {
  fill: none;
  vertical-align: middle;
}
.btn-radio svg circle {
  stroke-width: 2;
  stroke: #C8CCD4;
}
.btn-radio svg path {
  stroke: #008FFF;
}
.btn-radio svg path.inner {
  stroke-width: 6;
  stroke-dasharray: 19;
  stroke-dashoffset: 19;
}
.btn-radio svg path.outer {
  stroke-width: 2;
  stroke-dasharray: 57;
  stroke-dashoffset: 57;
}
.btn-radio input {
  display: none;
}
.btn-radio input:checked + svg path {
  transition: all 0.4s ease;
}
.btn-radio input:checked + svg path.inner {
  stroke-dashoffset: 38;
  transition-delay: 0.3s;
}
.btn-radio input:checked + svg path.outer {
  stroke-dashoffset: 0;
}
.btn-radio span {
  display: inline-block;
  vertical-align: middle;
}


  /* The container */
  .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 16px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
  }

  /* Hide the browser's default radio button */
  .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
  }

  /* Create a custom radio button */
  .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
  }

  /* On mouse-over, add a grey background color */
  .container:hover input ~ .checkmark {
      background-color: #ccc;
  }

  /* When the radio button is checked, add a blue background */
  .container input:checked ~ .checkmark {
      background-color: #2ebeef;
  }

  /* Create the indicator (the dot/circle - hidden when not checked) */
  .checkmark:after {
      content: "";
      position: absolute;
      display: none;
  }

  /* Show the indicator (dot/circle) when checked */
  .container input:checked ~ .checkmark:after {
      display: block;
  }

  /* Style the indicator (dot/circle) */
  .container .checkmark:after {
   	top: 9px;
  	left: 9px;
  	width: 8px;
  	height: 8px;
  	border-radius: 50%;
  	background: white;
  }


  /*for loading*/
  #loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    margin-top:210px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  /*for loading*/
  #loader-modal {
    position: absolute;
    left: 50%;
    bottom: 5%;
    z-index: 1;
    width: 40px;
    height: 40px;
    margin: -30px 0 0 -30px;
    border: 8px solid #f3f3f3;
    border-radius: 50%;
    border-top: 8px solid #f68628;
    width: 50px;
    height: 50px;
    margin-top:210px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Add animation to "page content" */
  .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
  }

  @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 }
    to { bottom:0px; opacity:1 }
  }

  @keyframes animatebottom {
    from{ bottom:-100px; opacity:0 }
    to{ bottom:0; opacity:1 }
  }

  #frame {
    display: none;
    text-align: center;
  }
</style>

<div id="foot"></div>
@endsection
