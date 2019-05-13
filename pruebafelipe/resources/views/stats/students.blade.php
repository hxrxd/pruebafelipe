@extends('statstemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Estudiantes</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>

    
      <form id="selectRE">
        <div class="form-group">
          <label for="sel1">Lista de tipos de reportes:</label>
          <select class="form-control" id="sel1">
            <option selected>Seleccione ...</option>
            <option value="rE">Resumen de Estudiantes</option>
            <option value="ExUA">Estudiantes por Unidad Académica</option>
            <option value="ExD">Estudiantes por Disciplina</option>
            <option value="ExTP">Estudiantes por Tipo de Práctica</option>
          </select>
          <div class="input-group-append">
            <button id="btnS" class="btn btn-outline-secondary" type="button">Seleccionar</button>
          </div>
        </div>
      </form>

  <div id="rE">
		<h2>Resumen de Estudiantes</h2>
		<div style="margin-bottom: 20px;">
			<table class="table " style="width:100%">
        <thead>
					<tr>
            <th>Total Estudiantes</th>
            <th>Hombres</th>
            <th>Mujeres</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-indico">{{ number_format($total_stds) }}</td>
              <td class="color-blue">{{ number_format($total_stds_men) }} ({{ number_format($total_stds_men * 100 / $total_stds) }}%)</td>
              <td class="color-orange">{{ number_format($total_stds_women) }} ({{ number_format($total_stds_women * 100 / $total_stds) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

		<div style="margin-bottom: 20px;" class="table-responsive">
			<table class="table datatable responsive" style="width:100%">
        <thead>
					<tr>
            <th>Cohorte</th>
            <th style="text-align:right;">Hombres</th>
            <th style="text-align:right;">Mujeres</th>
						<th style="text-align:right;">Total</th>
            <th style="text-align:right;">% Hombres</th>
            <th style="text-align:right;">% Mujeres</th>
          </tr>
        </thead>
        <tbody>
          <p style="display:none">{{$i = 0}}</p>
					@foreach($stds_by_cohort_men as $sbc)

          <tr>
						<td>{{ $sbc->cohort }}</td>
						<td style="text-align:right;">{{ number_format($sbc->men) }}</td>
            <td style="text-align:right;">{{ number_format($stds_by_cohort_women[$i]->women) }}</td>
            <td style="text-align:right;">{{ number_format($sbc->men + $stds_by_cohort_women[$i]->women) }}</td>
            <td style="text-align:right;">{{ number_format($sbc->men*100/($sbc->men + $stds_by_cohort_women[$i]->women)) }}%</td>
            <td style="text-align:right;">{{ number_format($stds_by_cohort_women[$i]->women*100/($sbc->men + $stds_by_cohort_women[$i]->women)) }}%</td>
          </tr>

          <p style="display:none">{{$i = $i+1}}</p>
					@endforeach

					<tr>
						<td class="color-blue" style="font-size:16px;">Total</td>
						<td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_men) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_women) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds) }}</td>
            <td class="color-blue" style="font-size:16px;"></td>
            <td class="color-blue" style="font-size:16px;"></td>
          </tr>
        </tbody>
      </table>
		</div>
  </div>

  <div id="ExUA">
    <h2>Estudiantes por Unidad Académica</h2>
    <div id="header-1" class="table-responsive" style="background-color:white;margin-bottom: 60px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Total Estudiantes</th>
            <th>{{$stds_by_au[0]->au}}</th>
            <th>{{$stds_by_au[1]->au}}</th>
            <th>{{$stds_by_au[2]->au}}</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-blue">{{ number_format($total_stds) }}</td>
              <td class="color-indico">{{ number_format($stds_by_au[0]->numstds) }} ({{ number_format($stds_by_au[0]->numstds * 100 / $total_stds) }}%)</td>
              <td class="color-blue">{{ number_format($stds_by_au[1]->numstds) }} ({{ number_format($stds_by_au[1]->numstds * 100 / $total_stds) }}%)</td>
              <td class="color-orange">{{ number_format($stds_by_au[2]->numstds) }} ({{ number_format($stds_by_au[2]->numstds * 100 / $total_stds) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-1" style="margin-bottom: 60px;">
      <div id="bye">
      <!--  <table id="table_id" class="table display responsive no-wrap" style="width:100%">
        </table>-->
        <div id="tableUA" class="form-horizontal"></div>
        <table class="table" style="width:100%">
          <thead>
					  <tr>
            <th></th>
            <th style="text-align:right;">Hombres</th>
						<th style="text-align:right;">Mujeres</th>
            <th style="text-align:right;">Total</th>
            <th style="text-align:right;"></th>
            <th style="text-align:right;"></th>
            <th style="text-align:right;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="color-blue" style="font-size:16px;">Total</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_men) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_women) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="dataUA">@foreach($stds_by_au as $sba)["{{ $sba->au }}", "{{ number_format($sba->men) }}", "{{ number_format($sba->women) }}", "{{ number_format($sba->numstds) }}", "{{ number_format($sba->men * 100 / $sba->numstds,2) }}%", "{{ number_format($sba->women * 100 / $sba->numstds,2) }}%", "{{ number_format($sba->numstds * 100 / $total_stds,2) }}%"],@endforeach</div>

  <div id="ExD">
    <h2>Estudiantes por Disciplina</h2>

    <div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Total Estudiantes</th>
            <th>{{$stds_by_career[0]->career}}</th>
            <th>{{$stds_by_career[1]->career}}</th>
            <th>{{$stds_by_career[2]->career}}</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-blue">{{ number_format($total_stds) }}</td>
              <td class="color-indico">{{ number_format($stds_by_career[0]->numstds) }} ({{ number_format($stds_by_career[0]->numstds * 100 / $total_stds) }}%)</td>
              <td class="color-blue">{{ number_format($stds_by_career[1]->numstds) }} ({{ number_format($stds_by_career[1]->numstds * 100 / $total_stds) }}%)</td>
              <td class="color-orange">{{ number_format($stds_by_career[2]->numstds) }} ({{ number_format($stds_by_career[2]->numstds * 100 / $total_stds) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div style="margin-bottom: 60px;">
      <div class="table-responsive">
        <table class="table" style="width:100%">
          <thead>
            <tr>
              <th>Disciplina</th>
              <th style="text-align:right;">Hombres</th>
              <th style="text-align:right;">Mujeres</th>
              <th style="text-align:right;">Total</th>
              <th style="text-align:right;">% Hombres</th>
              <th style="text-align:right;">% Mujeres</th>
              <th style="text-align:right;">% del Total de Estudiantes</th>
            </tr>
          </thead>
          <tbody class="content-1">
            @foreach($stds_by_career as $sba)

            <tr>
              <td>{{ $sba->career }}</td>
              <td style="text-align:right;">{{ number_format($sba->men) }}</td>
              <td style="text-align:right;">{{ number_format($sba->women) }}</td>
              <td style="text-align:right;">{{ number_format($sba->numstds) }}</td>
              <td style="text-align:right;">{{ number_format($sba->men * 100 / $sba->numstds,2) }}%</td>
              <td style="text-align:right;">{{ number_format($sba->women * 100 / $sba->numstds,2) }}%</td>
              <td style="text-align:right;">{{ number_format($sba->numstds * 100 / $total_stds,2) }}%</td>
            </tr>

            @endforeach

            <tr>
              <td class="color-blue" style="font-size:16px;">Total</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_men) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_women) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="ExTP">
    <h2>Estudiantes por Tipo de Práctica</h2>
    <div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Total Estudiantes</th>
            <th>{{$stds_by_practice[0]->shortname}}</th>
            <th>{{$stds_by_practice[1]->shortname}}</th>
            <th>{{$stds_by_practice[2]->shortname}}</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-blue">{{ number_format($total_stds) }}</td>
              <td class="color-indico">{{ number_format($stds_by_practice[0]->numstds) }} ({{ number_format($stds_by_practice[0]->numstds * 100 / $total_stds) }}%)</td>
              <td class="color-blue">{{ number_format($stds_by_practice[1]->numstds) }} ({{ number_format($stds_by_practice[1]->numstds * 100 / $total_stds) }}%)</td>
              <td class="color-orange">{{ number_format($stds_by_practice[2]->numstds) }} ({{ number_format($stds_by_practice[2]->numstds * 100 / $total_stds) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-1" style="margin-bottom: 60px;">
      <div class="table-responsive">
        <table class="table" style="width:100%">
          <thead>
            <tr>
              <th>Tipo de práctica</th>
              <th style="text-align:right;">Total Estudiantes</th>
              <th style="text-align:right;">%</th>
            </tr>
          </thead>
          <tbody class="content-1">
            @foreach($stds_by_practice as $sba)

            <tr>
              <td>{{ $sba->name }} ({{ $sba->shortname }})</td>
              <td style="text-align:right;">{{ number_format($sba->numstds) }}</td>
              <td style="text-align:right;">{{ number_format($sba->numstds * 100 / $total_stds,2) }}%</td>
            </tr>

            @endforeach

            <tr>
              <td class="color-blue" style="font-size:16px;">Total</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>

  <div style="display:none" id="loader-modal"></div>

  <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content animated fadeIn">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <i class="fa fa-bar-chart-o modal-icon"></i>
          <h1 class="modal-title">¡Bienvenido a<br>Estadísticas de EPSUM!</h1>
        </div>
        <div class="modal-body">
          <p>¡Mira el aporte de los equipos multidisciplinarios de EPSUM en cifras! Selecciona una de las opciones del menú lateral para conocer más.</p>
          <p>Estadísticas de EPSUM es un proyecto basado en los datos registrados en el Sistema MiE 2.0, mismos que son ingresados por los estudiantes como parte de su trabajo realizado en EPSUM, desde su proceso de registro en la plataforma, hasta el ingreso de sus informes diagnósticos y de proyectos.</p>
          <p><strong>Estadísticas de EPSUM aún está en desarrollo, por tal razón, pueden existir cambios en la distribución de información sin previo aviso.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">¡Entendido!</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
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

  
  function convertObjectJSON(data) {
    var newData = '['+data+']';
    return JSON.parse(newData);
  }

  function deleteLastC(data) {
    return data.substr(0,data.length-1);
  }
  var languageData = '{"processing":"Cargando datos...","search": "Buscar","lengthMenu": "Mostrar _MENU_ datos","info": "Numero de páginas mostradas _PAGE_ of _PAGES_","infoEmpty":"No se encuentra datos disponibles","infoFiltered":"(Filtrado por _MAX_ total de datos)","loadingRecords": "Cargando datos...","zeroRecords":"No se encuentra información - Lo sentimos","emptyTable":"No se encuentra datos disponibles","paginate": {"first":"Primera","previous":"Anterior","next":"Siguiente","last":"Última"}}';
  var objLanguage = JSON.parse(languageData);

  function initTableUA() {
    var table;
    var dataSet = convertObjectJSON(deleteLastC(jQuery('#dataUA').text()));
    console.log(dataSet);
    jQuery('#tableUA').html('');
    jQuery('<table/>',{
                        'class': 'table-striped table-hover display responsive no-wrap table table-striped table-hover dt-responsive display nowrap',
                        'cellspacing':'0',
                        'id': 'table_id',
                        'width': '100%'
                    }).appendTo('#tableUA');
      table = jQuery('#table_id').DataTable({ "lengthMenu": [[-1], ["Todos"]], responsive: true, "language": objLanguage,
        data: dataSet,
        columns: [
            { title: "Unidad Académica" },
            { title: "Hombres" },
            { title: "Mujeres" },
            { title: "Total" },
            { title: "% Hombres" },
            { title: "% Mujeres" },
            { title: "% de Total de Estudiantes" }
        ]
   });
   table.search('Centro Universitario de Oriente').draw();
  }

  function getReport(e) {
    e.preventDefault();
    var data = jQuery("#sel1").val();
    if (data.trim()=="rE") {
      jQuery("#rE").show();
    } else if (data.trim()=="ExUA") {
      initTableUA();
      jQuery("#ExUA").show();
      if(jQuery(window).width() < 768){
        //document.getElementById("ExUA").reload();
        console.log("Ingreso");
        initTableUA();
      }
    } else if(data.trim()=="ExD"){
      jQuery("#ExD").show();
    } else if(data.trim()=="ExTP"){
      jQuery("#ExTP").show();
    }
  }
 
			
  function hideReport() {
    jQuery("#ExTP").hide();
    jQuery("#ExD").hide();
    jQuery("#ExUA").hide();
    jQuery("#rE").hide();
  }
  
  jQuery(document).ready(function() {
    jQuery("#btnS").click(getReport);
    jQuery("#sel1").change(hideReport);
    resizePadding();
    hideReport();
    jQuery('#dataUA').hide();

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

  $(document).ready(function () {
    /*var init_type = "Multidisciplinario"
    updateChartProjectTypeByLine(init_type);
    updateChartUsersByProject(init_type);*/
  });

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');
    }
  }, 500);

  // DEPRECATED
  function removeData(chart) {
      chart.data.labels.pop();
      chart.data.datasets.forEach((dataset) => {
          dataset.data.pop();
      });
      //chart.data.datasets.data = [];
      chart.update();
  }

  function showLegendChart(chart, toggle) {
      chart.options.legend.display = toggle;
      chart.update();
  }

  function loadingReportPDF(){
    document.getElementById("frame").style.opacity = 0.5;
    document.getElementById("loader-modal").style.display = "block";
    var interval = setInterval(function() {
      document.getElementById("frame").style.opacity = 1;
      document.getElementById("loader-modal").style.display = "none";
    }, 10000);
  }

  function shuffle(arra1) {
    var ctr = arra1.length, temp, index;

    while (ctr > 0) {
        index = Math.floor(Math.random() * ctr);
        ctr--;
        temp = arra1[ctr];
        arra1[ctr] = arra1[index];
        arra1[index] = temp;
    }
    return arra1;
  }

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
