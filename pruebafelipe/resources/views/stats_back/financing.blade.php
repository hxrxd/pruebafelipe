@extends('admintemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Financiamiento y Becas</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>    

    <h2>Financiamiento</h2>
    <div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>EPSUM</th>
            <th>EPSUM/MINFIN</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-indico">{{ number_format($financing_epsum) }} ({{ number_format($financing_epsum * 100 / $total_stds) }}%)</td>
              <td class="color-orange">{{ number_format($financing_epsum_minfin) }} ({{ number_format($financing_epsum_minfin * 100 / $total_stds) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-1" style="margin-bottom: 60px;">
      <div>
        <table class="table" style="width:100%">
          <thead>
            <tr>
              <th>Cohorte</th>
              <th style="text-align:right;">Financiados por EPSUM</th>
              <th style="text-align:right;">Financiados por EPSUM/MINFIN</th>
              <th style="text-align:right;">Total Estudiantes</th>
              <th style="text-align:right;">% EPSUM</th>
              <th style="text-align:right;">% EPSUM/MINFIN</th>
            </tr>
          </thead>
          <tbody class="content-1">
            @foreach($stds_by_financing as $sba)

            <tr>
              <td>{{ $sba->cohort }}</td>
              <td style="text-align:right;">{{ number_format($sba->f1) }}</td>
              <td style="text-align:right;">{{ number_format($sba->f2) }}</td>
              <td style="text-align:right;">{{ number_format($sba->numstds) }}</td>
              <td style="text-align:right;">{{ number_format($sba->f1 * 100 / $sba->numstds,2) }}%</td>
              <td style="text-align:right;">{{ number_format($sba->f2 * 100 / $sba->numstds,2) }}%</td>
            </tr>

            @endforeach

            <tr>
              <td class="color-blue" style="font-size:16px;">Total</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($financing_epsum) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($financing_epsum_minfin) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_stds) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <h2>Becas por Cohorte</h2>
    <div style="margin-bottom: 20px;">
      <h1>Q. {{ number_format($grant,2) }}</h1>
      <p style="text-align: center; margin-top:0px; padding-top:0px">Total en Becas</p>
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>EPSUM</th>
            <th>EPSUM/MINFIN</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-indico">Q. {{ number_format($grant_epsum,2) }} ({{ number_format($grant_epsum * 100 / $grant) }}%)</td>
              <td class="color-orange">Q. {{ number_format($grant_epsum_minfin,2) }} ({{ number_format($grant_epsum_minfin * 100 / $grant) }}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-1" style="margin-bottom: 60px;">
      <div>
        <table class="table" style="width:100%">
          <thead>
            <tr>
              <th>Cohorte</th>
              <th style="text-align:right;">EPSUM</th>
              <th style="text-align:right;">EPSUM/MINFIN</th>
              <th style="text-align:right;">Total</th>
              <th style="text-align:right;">% EPSUM</th>
              <th style="text-align:right;">% EPSUM/MINFIN</th>
            </tr>
          </thead>
          <tbody class="content-1">
            @foreach($stds_by_grant as $sba)

            <tr>
              <td>{{ $sba->cohort }}</td>
              <td style="text-align:right;">Q. {{ number_format($sba->g1,2) }}</td>
              <td style="text-align:right;">Q. {{ number_format($sba->g2,2) }}</td>
              <td style="text-align:right;">Q. {{ number_format($sba->total_grant,2) }}</td>
              <td style="text-align:right;">{{ number_format($sba->g1 * 100 / $sba->total_grant,2) }}%</td>
              <td style="text-align:right;">{{ number_format($sba->g2 * 100 / $sba->total_grant,2) }}%</td>
            </tr>

            @endforeach

            <tr>
              <td class="color-blue" style="font-size:16px;">Total</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($grant_epsum,2) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($grant_epsum_minfin,2) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($grant,2) }}</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <h2>Relación Costo Beneficio</h2>
    <div style="margin-bottom: 20px;">
      <p style="text-align: center; margin-top:0px; padding-top:0px">(EN DESARROLLO)</p>
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Relación</th>
            <th>Inversión</th>
            <th>Beneficio</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-indico">0</td>
              <td class="color-blue">Q. 0.00</td>
              <td class="color-orange">Q. 0.00</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div id="fly-away-1" style="margin-bottom: 60px;">
      <div>
        <table class="table" style="width:100%">
          <thead>
            <tr>
              <th>Cohorte</th>
              <th style="text-align:right;">Total de Aporte de proyectos</th>
              <th style="text-align:right;">Total en Becas</th>
              <th style="text-align:right;">Relación Costo Beneficio</th>
            </tr>
          </thead>
          <tbody class="content-1">
            @foreach($stds_by_grant as $sba)

            <tr>
              <td>{{ $sba->cohort }}</td>
              <td style="text-align:right;">Q. 0.00</td>
              <td style="text-align:right;">Q. 0.00</td>
              <td style="text-align:right;">0</td>
            </tr>

            @endforeach

            <tr>
              <td class="color-blue" style="font-size:16px;">Total</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. 0.00</td>
              <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. 0.00</td>
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
    background: #e6e6e6;
    color: #7b7b7b;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
  }
  .select select::-ms-expand {
    display: none;
  }
  .select select:hover,
  .select select:focus {
    color: #000;
    background: #ccc;
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
    border-color: #7b7b7b transparent transparent transparent;
  }
  .select select:hover ~ .select__arrow,
  .select select:focus ~ .select__arrow {
    border-top-color: #000;
  }
  .select select:disabled ~ .select__arrow {
    border-top-color: #ccc;
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
