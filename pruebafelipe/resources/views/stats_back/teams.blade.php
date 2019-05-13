@extends('admintemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Equipos</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>

    <!-- FUNCTIONS FOR LATER -->

    <!--<div class="row filters" style="margin-top:35px;">
      <div class="col-sm-4">
        <p>Cohorte</p>
        <div class="select" id="filter-1">
            <select name="cohort_select" >
              <option value="all" selected>Todas las cohortes</option>
              @foreach ($cohorts as $c => $value)
                <option value="{{ $value->id }}">{{ $value->cohort }}</option>
              @endforeach
            </select>
            <div class="select__arrow"></div>
        </div>
      </div>
      <div class="col-sm-4">
        <p>Departamento</p>
        <div class="select">
            <select name="dep_select" >
              <option value="all" selected>Todos los departamentos</option>
              @foreach ($departments as $d => $value)
                <option value="{{ $value->id }}" selected>{{ $value->department }}</option>
              @endforeach
            </select>
            <div class="select__arrow"></div>
        </div>
      </div>
      <div class="col-sm-4">
        <p>Equipo</p>
        <div class="select">
            <select name="teams_select" >
              <option value="all" selected>Todos los equipos</option>
              @foreach ($teams as $t => $value)
                <option value="{{ $value->id }}" selected> {{ $value->team }}</option>
              @endforeach
            </select>
            <div class="select__arrow"></div>
        </div>
      </div>
    </div>-->

    <h2 id="title">Resumen General de Equipos</h2>
    <div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th id="header1">Equipos</th>
            <th>Integrantes</th>
            <th>Proyectos</th>
            <th>Aporte</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-blue">{{ number_format($total_teams) }}</td>
              <td class="color-indico">{{ number_format($total_members) }}</td>
              <td class="color-blue">{{ number_format($total_pjs) }}</td>
              <td class="color-orange">Q. {{ number_format($total_budget,2) }}</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-1" style="margin-bottom: 60px;">
      <div class="tableContainer">
        <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
          <thead class="fixedHeader">
            <tr>
              <th width="20%">Equipo</th>
              <th width="15%">Departamento</th>
              <th width="15%">Municipio</th>
              <th width="20%">Supervisor</th>
              <th width="10%" style="text-align:right;">Integrantes</th>
              <th width="20%" style="text-align:right;">Aporte (registrado)</th>
            </tr>
          </thead>
          <tbody class="scrollContent">
            @foreach($teams_by_cohort as $tbc)

            <tr>
              <td width="20%">{{ $tbc->team }}</td>
              <td width="15%">{{ $tbc->dep }}</td>
              <td width="15%">{{ $tbc->mun }}</td>
              <td width="20%">{{ $tbc->sup }}</td>
              <td width="10%" style="text-align:right;">{{ number_format($tbc->members) }}</td>
              <td width="20%" style="text-align:right;">Q. {{ number_format($tbc->contrib,2) }}</td>
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
      <table class="table">
        <tbody >
          <tr>
            <td width="20%" class="color-blue" style="font-size:16px;">Total</td>
            <td width="15%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            <td width="15%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_members) }}</td>
            <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($total_budget,2) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <h2 id="title">Equipos con mayor cantidad de asignaciones</h2>
    <div class="row" style="padding-top:40px;padding-bottom:40px">
      <div id="chartBox4" class="col-sm-12">
        <canvas id="chart4" width="200" height="75"></canvas>
      </div>
    </div>


    <h2 id="title">Equipos por cohorte</h2>
    <div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Estudiantes 2C-2017</th>
            <th>Estudiantes 1C-2018</th>
            <th>Estudiantes 2C-2018</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-indico">{{ number_format($total_members_2c2107) }}</td>
              <td class="color-blue">{{ number_format($total_members_1c2108) }}</td>
              <td class="color-orange">{{ number_format($total_members_2c2108) }}</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-2" style="margin-bottom: 60px;">
      <div class="tableContainer">
        <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
          <thead class="fixedHeader">
            <tr>
              <th width="10%">Equipo</th>
              <th width="10%" style="text-align:right;">Integrantes 2C-2017</th>
              <th width="10%" style="text-align:right;">Integrantes 1C-2018</th>
              <th width="10%" style="text-align:right;">Integrantes 2C-2018</th>
              <th width="20%" style="text-align:right;">Aporte 2C-2017</th>
              <th width="20%" style="text-align:right;">Aporte 1C-2018</th>
              <th width="20%" style="text-align:right;">Aporte 2C-2018</th>
            </tr>
          </thead>
          <tbody class="scrollContent">
            @foreach($teams_b_c as $tbc)

            <tr>
              <td width="10%">{{ $tbc->team }}</td>
              <td width="10%" style="text-align:right;">{{ number_format($tbc->members2c2017) }}</td>
              <td width="10%" style="text-align:right;">{{ number_format($tbc->members1c2018) }}</td>
              <td width="10%" style="text-align:right;">{{ number_format($tbc->members2c2018) }}</td>
              <td width="20%" style="text-align:right;">Q. {{ number_format($tbc->contrib2c2017,2) }}</td>
              <td width="20%" style="text-align:right;">Q. {{ number_format($tbc->contrib1c2018,2) }}</td>
              <td width="20%" style="text-align:right;">Q. {{ number_format($tbc->contrib2c2018,2) }}</td>
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td width="10%" class="color-blue" style="font-size:16px;">Total</td>
            <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_members_2c2107) }}</td>
            <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_members_1c2108) }}</td>
            <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_members_2c2108) }}</td>
            <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($total_budgets[1]->budget,2) }}</td>
            <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($total_budgets[0]->budget,2) }}</td>
            <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. 0.00</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

  <div style="display:none" id="loader-modal"></div>

  <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content animated fadeIn">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <i class="fa fa-warning modal-icon"></i>
          <h1 class="modal-title">Estadísticas de EPSUM</h1>
          <h3>¡IMPORTANTE!</h3>
        </div>
        <div class="modal-body">
          <p>Las cifras mostradas en el siguiente reporte corresponden a los datos registrados en el Sistema MiE 2.0., por tal razón, se debe tomar en cuenta este aviso en el caso de que la información no sea correcta.</p>
          <p><strong>Reportes de EPSUM aún está en desarrollo, por lo que pueden existir cambios en la distribución de información sin previo aviso.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">¡Entendido!</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://codepen.io/anon/pen/aWapBE.js"></script>
<script type="text/javascript">

  $(window).on('load',function(){
      $('#myModal').modal('show');
      initializeSelects();
      updateChartTeamGeneral();
  });

  var current_cohort = "all";
  var current_team = -1;
  var current_depto = -1;

  function initializeSelects(){
    $('select[name="cohort_select"] option:eq(0)').prop('selected', true);
    $('select[name="dep_select"] option:eq(0)').prop('selected', true);
    $('select[name="teams_select"] option:eq(0)').prop('selected', true);
    $('select[name="dep_select"]').prop('disabled',true);
    $('select[name="teams_select"]').prop('disabled',true);
  }


  /* GO TO THE TOP

    $("#filter-1").click(function() {
    $('html,body').animate({
        scrollTop: $(".filters").offset().top},
        'slow');
  });*/

  var gamma = [ '#004455', '#2c89a0', '#69d2e7', '#aaccff', '#e0e4cc',
                '#ffb380', '#fa6900', '#ffcc00', '#ffe680', '#e9ddaf',
                '#ddff55', '#668000'];

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');
    }
  }, 500);

  function updateChartProjectTypeByLine(type_project_by_line){
    $.ajax({
  		url: '{{asset("/stats/chart/projs/line/type")}}'.replace('type',type_project_by_line),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var lines= [];
  			var vals = [];
        //shuffle(gamma);

  			for(var i in data) {
  				lines.push(data[i].line);
  				vals.push(data[i].numprojs);
  			}

  			var chartdata = {
  				labels: lines,
  				datasets : [
  					{
  						label: 'Proyectos Multidisciplinarios por Línea de Intervención',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx1 = document.getElementById('chart1').getContext('2d');

  			var chart_projects_by_line = new Chart(ctx1, {
  				type: 'pie',
  				data: chartdata,
          options:{
            legend: {
                  display: false,
                  position: 'bottom',
                  boxWidth: 10,
                  labels: {
                      padding: 10,
                  }
              },

              tooltips: {
                callbacks: {
                  label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                    var total = meta.total;
                    var currentValue = dataset.data[tooltipItem.index];
                    var percentage = parseFloat((currentValue/total*100).toFixed(1));
                    return currentValue + ' (' + percentage + '%)';
                  },
                  title: function(tooltipItem, data) {
                    return data.labels[tooltipItem[0].index];
                  }
                }
              },
          },
  			});
        console.log(data);
  		},

  		error: function(data) {
  			console.log(data);
  		}
  	});
  }

  function updateChartTeamGeneral(){
    $.ajax({
  		url: '{{asset("/stats/chart/team/general")}}',
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var x= [];
  			var vals = [];
        //shuffle(gamma);

  			for(var i in data) {
          if(data[i].team.length > 15){
            data[i].team = data[i].team.substring(0,15)+"..."
          }
  				x.push(data[i].team);
  				vals.push(data[i].members);
  			}

  			var chartdata = {
  				labels: x,
  				datasets : [
  					{
  						label: 'Equipo',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx4 = document.getElementById('chart4').getContext('2d');

  			chart_users_by_project = new Chart(ctx4, {
  				type: 'bar',
  				data: chartdata,
          options:{
            legend: {
                  display: false,
                  position: 'bottom',
                  boxWidth: 10,
                  labels: {
                      padding: 10,
                  }
              },

              scales: {
                xAxes: [{
                  ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                      return '' + value;
                    }
                  }
                }],

              }
          },
  			});
        console.log(data);
  		},

  		error: function(data) {
  			console.log(data);
  		}
  	});
  }

  $('select[name="cohort_select"]').on('change', function(e){
    var cid = $(this).val();
    current_cohort = $('select[name="cohort_select"] option:selected').text();
    console.log("COHORTE:"+current_cohort);

    if(cid != 'all') {
      $('select[name="dep_select"]').prop('disabled',false);
      $('select[name="teams_select"]').prop('disabled',false);
      //document.getElementById('fly-away-1').style.display = "none";
      //$('#fly-away-1').fadeOut('slow');
      //$('#fly-away-2').fadeIn('slow');

      $.ajax({
        url: '{{asset("stats/teams/cohort")}}'.replace('cohort',current_cohort),
        type:"GET",
        dataType:"json",

        success:function(data) {
          $('#table-cohorts').empty();
          $('#table-cohorts').append('<thead><tr><th width="20%">Equipo</th><th width="15%">Departamento</th><th width="15%">Municipio</th><th width="20%">Supervisor</th><th width="10%" style="text-align:right;">Integrantes</th><th width="20%" style="text-align:right;">Aporte (registrado)</th></tr></thead>');
          $('#table-cohorts').append('<tbody class="scrollContent">');
          data.forEach(function(t){
            $('#table-cohorts').append('<tr><td width="20%">'+t.team+'</td><td width="15%">'+t.dep+'</td><td width="15%">'+t.mun+'</td><td width="20%">'+t.sup+'</td><td width="10%" style="text-align:right;">'+t.members+'</td><td width="20%" style="text-align:right;">Q. '+t.contrib+'</td></tr>');
          });
          $('#table-cohorts').append('</tbody>');
        },
      });

    } else {
      $('select[name="dep_select"]').prop('disabled',true);
      $('select[name="teams_select"]').prop('disabled',true);
      //document.getElementById('fly-away-1').style.display = "block";
      $('#fly-away-1').fadeIn('slow');
      $('#fly-away-2').fadeOut('slow');
    }
  });

  $('select[name="dep_select"]').on('change', function(e){
    var depid = $(this).val();

    if(depid != 'all') {

      $.ajax({
        url: '{{asset("teams/get/id")}}'.replace('id',depid),
        type:"GET",
        dataType:"json",

        success:function(data) {
          $('select[name="teams_select"]').empty();
          if(data.length == 0){
            $('select[name="teams_select"]').append('<option value=0>No hay equipos</option>');
            $('select[name="teams_select"]').prop('disabled',true);
          }else{
            $('select[name="teams_select"]').prop('disabled',false);
            $('select[name="teams_select"]').append('<option value="all">Todos los equipos');
            $.each(data, function(key, value){
              console.log('key: '+key+' val: '+value);
              $('select[name="teams_select"]').append('<option value="'+ key +'">' + value + '</option>');
            });
          }
        },
      });
    } else {
      $('select[name="teams_select"]').empty();
      $('select[name="teams_select"]').append('<option value="all">Todos los equipos</option>');
      var teams = {!! json_encode($teams) !!};
      teams.forEach(function(t){
        $('select[name="teams_select"]').append('<option value="'+ t.id +'">' + t.team + '</option>');
      });

      //change other selects
      $('select[name="cohort_select"] option:eq(0)').prop('selected', true);
      $('select[name="teams_select"] option:eq(0)').prop('selected', true);
    }
  });

  function loadingReportPDF(){
    document.getElementById("frame").style.opacity = 0.5;
    document.getElementById("loader-modal").style.display = "block";
    var interval = setInterval(function() {
      document.getElementById("frame").style.opacity = 1;
      document.getElementById("loader-modal").style.display = "none";
    }, 10000);
  }

  $(document).ready(function () {
      $('.chk-mult-1').click(function(){
          //chart_projects_by_line.destroy();
          $('#chart4').remove();
          $('#chartBox4').append('<canvas id="chart4" width="200" height="100"></canvas>');
          updateChartUsersByProject("Multidisciplinario");

      });

      $('.chk-mono-1').click(function(){
          $('#chart4').remove();
          $('#chartBox4').append('<canvas id="chart4" width="200" height="100"></canvas>');
          updateChartUsersByProject("Monodisciplinario");

      });

      $('.chk-conv-1').click(function(){
          $('#chart4').remove();
          $('#chartBox4').append('<canvas id="chart4" width="200" height="100"></canvas>');
          updateChartUsersByProject("Convivencia");

      });
  });

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
    width: 100%;
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

  .select {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
    width: 100%;
  }
  .select select {
    display: inline-block;
    width: 100%;
    cursor: pointer;
    padding: 10px 15px;
    outline: 0;
    border: 0;
    border-radius: 0;
    background: #f68628;
    color: #fff;
    font-size: 18px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
  }
  .select select::-ms-expand {
    display: none;
  }
  .select select:hover,
  .select select:focus {
    color: #fff;
    background: #02556e;
  }
  .select select:disabled {
    opacity: 0.5;
    pointer-events: none;
  }
  .select__arrow {
    position: absolute;
    top: 16px;
    right: 15px;
    width: 0;
    height: 0;
    pointer-events: none;
    border-style: solid;
    border-width: 8px 5px 0 5px;
    border-color: #fff transparent transparent transparent;
  }
  .select select:hover ~ .select__arrow,
  .select select:focus ~ .select__arrow {
    border-top-color: #fff;
  }
  .select select:disabled ~ .select__arrow {
    border-top-color: #fff;
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

  /* define height and width of scrollable area. Add 16px to width for scrollbar          */
  div.tableContainer {
  	clear: both;
  	height: 285px;
  	overflow: auto;
  }

  /* Reset overflow value to hidden for all non-IE browsers. */
  html>body div.tableContainer {
  	overflow: hidden;
  }

  /* define width of table. IE browsers only                 */
  div.tableContainer table {
  	float: left;
  	/* width: 740px */
  }

  /* define width of table. Add 16px to width for scrollbar.           */
  /* All other non-IE browsers.                                        */
  html>body div.tableContainer table {
  	/* width: 756px */
  }

  /* set table header to a fixed position. WinIE 6.x only                                       */
  /* In WinIE 6.x, any element with a position property set to relative and is a child of       */
  /* an element that has an overflow property set, the relative value translates into fixed.    */
  /* Ex: parent element DIV with a class of tableContainer has an overflow property set to auto */

  thead.fixedHeader tr {
  	position: relative;
  }

  html>body tbody.scrollContent {
  	display: block;
  	height: 250px;
  	overflow: auto;
  	width: 100%
  }

  html>body thead.fixedHeader {
  	display: table;
  	overflow: auto;
  	width: 100%
  }

  /* make TD elements pretty. Provide alternating classes for striping the table */
  /* http://www.alistapart.com/articles/zebratables/                             */
  tbody.scrollContent td, tbody.scrollContent tr.normalRow td {

  }

  tbody.scrollContent tr.alternateRow td {
  	background: #EEE;
  	border-bottom: none;
  	border-left: none;
  	border-right: 1px solid #CCC;
  	border-top: 1px solid #DDD;

  }
  </style>

@endsection
