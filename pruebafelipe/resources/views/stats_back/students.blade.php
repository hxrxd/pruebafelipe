@extends('admintemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Estudiantes</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>


		<h2>Resumen de Estudiantes</h2>
		<div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
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

		<div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
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

    <h2>Estado civil de Estudiantes</h2>
		<div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Solteros(as)</th>
            <th>Casados(as)</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-blue">{{ number_format($total_stds_single) }} ({{ number_format($total_stds_single * 100 / $total_stds) }}%)</td>
              <td class="color-orange">{{ number_format($total_stds_married) }} ({{ number_format($total_stds_married * 100 / $total_stds) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

		<div style="margin-bottom: 40px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Cohorte</th>
            <th style="text-align:right;">Solteros</th>
            <th style="text-align:right;">Solteras</th>
						<th style="text-align:right;">Total</th>
            <th style="text-align:right;">% Solteros</th>
            <th style="text-align:right;">% Solteras</th>
            <th style="text-align:right;">Casados</th>
            <th style="text-align:right;">Casadas</th>
            <th style="text-align:right;">Total</th>
            <th style="text-align:right;">% Casados</th>
            <th style="text-align:right;">% Casadas</th>
          </tr>
        </thead>
        <tbody>
          <p style="display:none">{{$i = 0}}</p>
					@foreach($stds_by_cohort_men_single as $sbc)

          <tr>
						<td>{{ $sbc->cohort }}</td>
						<td style="text-align:right;">{{ number_format($sbc->single) }}</td>

            @if(sizeof($stds_by_cohort_women_single) <= $i)
              <td style="text-align:right;">0</td>
              <td style="text-align:right;">{{ number_format($sbc->single+0) }}</td>
              <td style="text-align:right;">{{ number_format($sbc->single*100/($sbc->single + 0)) }}%</td>
              <td style="text-align:right;">0</td>
            @else
              <td style="text-align:right;">{{ number_format($stds_by_cohort_women_single[$i]->single) }}</td>
              <td style="text-align:right;">{{ number_format($sbc->single + $stds_by_cohort_women_single[$i]->single) }}</td>
              <td style="text-align:right;">{{ number_format($sbc->single*100/($sbc->single + $stds_by_cohort_women_single[$i]->single)) }}%</td>
              <td style="text-align:right;">{{ number_format($stds_by_cohort_women_single[$i]->single*100/($sbc->single + $stds_by_cohort_women_single[$i]->single)) }}%</td>
            @endif


            @if(sizeof($stds_by_cohort_men_married) <= $i)
              <td style="text-align:right;">0</td>
            @else
              <td style="text-align:right;">{{ number_format($stds_by_cohort_men_married[$i]->married) }}</td>
            @endif

            @if(sizeof($stds_by_cohort_women_married) <= $i)
              <td style="text-align:right;">0</td>
            @else
              <td style="text-align:right;">{{ number_format($stds_by_cohort_women_married[$i]->married) }}</td>
            @endif

            @if(sizeof($stds_by_cohort_men_married) <= $i and sizeof($stds_by_cohort_women_married) <= $i)
              <td style="text-align:right;">0</td>
              <td style="text-align:right;">0%</td>
              <td style="text-align:right;">0%</td>
            @elseif(sizeof($stds_by_cohort_men_married) <= $i and sizeof($stds_by_cohort_women_married) > $i)
              <td style="text-align:right;">{{ 0 + $stds_by_cohort_women_married[$i]->married }}</td>
              <td style="text-align:right;">{{ number_format(0*100/($stds_by_cohort_men_married[$i]->married + $stds_by_cohort_women_married[$i]->married)) }}%</td>
              <td style="text-align:right;">{{ number_format($stds_by_cohort_women_married[$i]->married*100/(0 + $stds_by_cohort_women_married[$i]->married)) }}%</td>
            @elseif(sizeof($stds_by_cohort_men_married) > $i and sizeof($stds_by_cohort_women_married) <= $i)
              <td style="text-align:right;">{{ $stds_by_cohort_men_married[$i]->married + 0 }}</td>
              <td style="text-align:right;">{{ number_format($stds_by_cohort_men_married[$i]->married*100/($stds_by_cohort_men_married[$i]->married + 0)) }}%</td>
              <td style="text-align:right;">{{ number_format(0*100/($stds_by_cohort_men_married[$i]->married + $stds_by_cohort_women_married[$i]->married)) }}%</td>
            @else
              <td style="text-align:right;">{{ number_format($stds_by_cohort_men_married[$i]->married + $stds_by_cohort_women_married[$i]->married) }}</td>
              <td style="text-align:right;">{{ number_format($stds_by_cohort_men_married[$i]->married*100/($stds_by_cohort_men_married[$i]->married + $stds_by_cohort_women_married[$i]->married)) }}%</td>
              <td style="text-align:right;">{{ number_format($stds_by_cohort_women_married[$i]->married*100/($stds_by_cohort_men_married[$i]->married + $stds_by_cohort_women_married[$i]->married)) }}%</td>
            @endif

          </tr>

          <p style="display:none">{{$i = $i+1}}</p>
					@endforeach

					<tr>
						<td class="color-blue" style="font-size:16px;">Total</td>
						<td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_men_single) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_women_single) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_single) }}</td>
            <td class="color-blue" style="font-size:16px;"></td>
            <td class="color-blue" style="font-size:16px;"></td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_men_married) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_women_married) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds_married) }}</td>
            <td class="color-blue" style="font-size:16px;"></td>
            <td class="color-blue" style="font-size:16px;"></td>
          </tr>
        </tbody>
      </table>
      Pueden existir incongruencias entre el número de estudiantes hombres y mujeres y su estado civil debido a datos mal ingresados por los estudiantes durante su registro. (Ej: estudiantes (mujeres) que colocaron "soltero" como estado civil en vez de "soltera". Este caso es visible en los datos de la 1C -2019)
		</div>



    <h2>Estudiantes por Unidad Académica</h2>
    <div id="header-1" style="background-color:white;margin-bottom: 20px;">
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
      <div>
        <table class="table" style="width:100%">
          <thead>
            <tr>
              <th>Unidad Académica</th>
              <th style="text-align:right;">Hombres</th>
              <th style="text-align:right;">Mujeres</th>
              <th style="text-align:right;">Total</th>
              <th style="text-align:right;">% Hombres</th>
              <th style="text-align:right;">% Mujeres</th>
              <th style="text-align:right;">% del Total de Estudiantes</th>
            </tr>
          </thead>
          <tbody class="content-1">
            @foreach($stds_by_au as $sba)

            <tr>
              <td>{{ $sba->au }}</td>
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
      <div>
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
      <div>
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
  });


  //FOR FIX THE HEADER WHEN SCROLL

  /*var pos;
  var header = document.getElementById("header-1");
  var fly = document.getElementById("fly-away-1");
  var fixed = 0;

  window.onscroll = function() {myFunction()};

  function myFunction() {

    if (window.pageYOffset > pos.top) {
        header.style.position = "absolute";
        header.style.top = window.pageYOffset + "px";
    } else {
        header.style.position = "fixed";
        header.style.top = pos.top + "px";
    }
  }*/


  var gamma = [ '#004455', '#2c89a0', '#69d2e7', '#aaccff', '#e0e4cc',
                '#ffb380', '#fa6900', '#ffcc00', '#ffe680', '#e9ddaf',
                '#ddff55', '#668000'];
  var blue_array = [ '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7',
                '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7', '#69d2e7'];

  $(document).ready(function () {
    var init_type = "Multidisciplinario"
    updateChartProjectTypeByLine(init_type);
    updateChartUsersByProject(init_type);
  });

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');

      // FOR FIX THE HEADER WHEN SCROLLING
      /*pos = $("#header-1").position();
      var h = $('#header-1').height();
      fly.style.marginTop = 2*h+"px";*/
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

  // INIT THE CHART BUDGET BY COHORT

  $.ajax({
		url: '{{asset("/stats/chart/budget/cohort")}}',
		method: "GET",
		success: function(data) {
			console.log(data);
			var x= ['Cohortes 2016'];
			var vals = [4535545.00];
      //shuffle(gamma);

			for(var i in data.reverse()) {
				x.push(data[i].cohort);
				vals.push(data[i].budget);
			}

			var chartdata = {
				labels: x,
				datasets : [
					{
						label: 'Aporte (Q)',
            backgroundColor: ["#2c89a033"],
            borderColor: ["#2c89a0"],
						data: vals
					}
				],
			};

			var ctx2 = document.getElementById('chart2').getContext('2d');

			chart_budget_by_cohort = new Chart(ctx2, {
				type: 'line',
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
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                    if(parseInt(value) >= 1000){
                      return 'Q' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    } else {
                      return 'Q' + value;
                    }
                  }
                }
              }]
            }
        },
			});
      console.log(data);
		},

		error: function(data) {
			console.log(data);
		}
	});

  // INIT THE GRAPH BUDGET BY CAREER

  $.ajax({
		url: '{{asset("/stats/chart/budget/career")}}',
		method: "GET",
		success: function(data) {
			console.log(data);
			var x= [];
			var vals = [];
      //shuffle(gamma);

			for(var i in data) {
        if(data[i].career.length > 50){
          data[i].career = data[i].career.substring(0,50)+"..."
        }
				x.push(data[i].career);
				vals.push(data[i].bud_career);
			}

			var chartdata = {
				labels: x,
				datasets : [
					{
						label: 'Aporte (Q)',
            backgroundColor: blue_array,
						data: vals
					}
				],
			};

			var ctx3 = document.getElementById('chart3').getContext('2d');

			chart_budget_by_cohort = new Chart(ctx3, {
				type: 'horizontalBar',
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
                    if(parseInt(value) >= 1000){
                      return 'Q' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    } else {
                      return 'Q' + value;
                    }
                  }
                }
              }]
            }
        },
			});
      console.log(data);
		},

		error: function(data) {
			console.log(data);
		}
	});

  // FOR UPDATE THE CHART PROJECTS_DIRECT_USERS BY TYPE

  function updateChartUsersByProject(type_project){
    $.ajax({
  		url: '{{asset("/stats/chart/projects/directusers/type")}}'.replace('type',type_project),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var x= [];
  			var vals = [];
        //shuffle(gamma);

  			for(var i in data) {
  				x.push(data[i].name.substring(0,60)+"...");
  				vals.push(data[i].du);
  			}

  			var chartdata = {
  				labels: x,
  				datasets : [
  					{
  						label: 'Usuarios',
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
                      return '';
                    }
                  }
                }]
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


  // CHECKS USERS BY PROJECT TYPE

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

@endsection
