<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Proyectos</title>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
	</style>
</head>
<body>

  <div class="frame">
		<div class="logos">
			<img src="img/logo_vice.png" alt="logo-vice" width="auto" height="3%" style="padding-bottom:0; cursor: pointer;">
			<img src="img/logo_usac.png" alt="logo-usac" width="auto" height="3%" style="padding-bottom:0; cursor: pointer;">
			<img src="img/logo_epsum.png" alt="logo-epsum" width="auto" height="3%" style="padding-bottom:0; cursor: pointer;">
		</div>
    <h1>Reporte General de Proyectos</h1>
		<h3>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h3>

		<!--<h4 style="color:red">Este reporte en PDF aún está en desarrollo.</h4>-->

		<div style="margin-bottom: 20px;">
			<h2>Resumen de Proyectos</h2>
			<table class="table table-bordered" style="width:100%">
        <thead>
					<tr>
            <th>Total Proyectos</th>
            <th>Multidisciplinarios</th>
            <th>Convivencia</th>
            <th>Monodisciplinarios</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-indico">{{ $total_pjs }}</td>
              <td class="color-blue">{{ $total_mult }}</td>
              <td class="color-red">{{ $total_conv }}</td>
              <td class="color-orange">{{ $total_mono }}</td>
          </tr>
        </tbody>
      </table>

		</div>

		<div style="margin-bottom: 20px;">

			<table class="table table-bordered" style="width:100%">
        <thead>
					<tr>
            <th>Área</th>
            <th>Línea de Intervención</th>
            <th>Proyectos</th>
						<th>%</th>
          </tr>
        </thead>
        <tbody>
					<tr>
              <td rowspan="2" class="color-indico-2">Economía</td>
              <td>Agricultura familiar y mejoramiento de las economías campesinas</td>
              <td style="text-align:right;">{{ $total_line_1 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_1 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td>Desarrollo económico rural</td>
              <td style="text-align:right;">{{ $total_line_2 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_2 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td rowspan="3" class="color-blue-2">Salud</td>
              <td>Atención primaria en salud y salud comunitaria</td>
              <td style="text-align:right;">{{ $total_line_3 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_3 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td>Agua y saneamiento</td>
              <td style="text-align:right;">{{ $total_line_4 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_4 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td>Reducción de la vulnerabilidad nutricional</td>
              <td style="text-align:right;">{{ $total_line_5 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_5 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td class="color-red-2">Educación</td>
              <td>Fortalecimiento al sistema educativo</td>
              <td style="text-align:right;">{{ $total_line_6 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_6 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td rowspan="2" class="color-orange-2">Ambiente</td>
              <td>Vulnerabilidad, adaptabilidad al cambio climático y gestión de riesgo</td>
              <td style="text-align:right;">{{ $total_line_7 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_7 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td>Gestión integrada de desechos sólidos</td>
              <td style="text-align:right;">{{ $total_line_8 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_8 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td rowspan="2" class="color-indico-2">Gestión pública</td>
              <td>Fortalecimiento institucional en la gestión pública municipal</td>
              <td style="text-align:right;">{{ $total_line_9 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_9 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr>
              <td>Asociado a Unidad Académica</td>
              <td style="text-align:right;">{{ $total_line_10 }}</td>
							<td style="text-align:right;">{{ number_format($total_line_10 * 100 / $total_pjs,2) }}%</td>
          </tr>
					<tr class="color-blue">
              <td colspan="2">Total</td>
              <td style="text-align:right;">{{ $total_pjs }}</td>
							<td style="text-align:right;">100%</td>
          </tr>
        </tbody>
      </table>

		</div>


		<h2>Aporte económico de proyectos</h2>
		<div style="margin-bottom: 20px;">
  		<h1>Q. {{ number_format($budget_pjs,2) }}</h1>
  		<p style="text-align: center; margin-top:0px; padding-top:0px">Total proyectos</p>

			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Multidisciplinarios</th>
            <th>Convivencia</th>
            <th>Monodisciplinarios</th>
          </tr>
        </thead>
        <tbody>
					<tr class="numbers">
              <td class="color-blue">Q. {{ number_format($budget_mult,2) }}</td>
              <td class="color-red">Q. {{ number_format($budget_conv,2) }}</td>
              <td class="color-orange">Q. {{ number_format($budget_mono,2) }}</td>
          </tr>
        </tbody>
      </table>
		</div>

    <div style="margin-bottom: 60px;">
      <table class="table col-sm-3" style="width:100%">
        <thead>
          <tr>
            <th>Cohorte</th>
            <th>Multidisciplinario</th>
            <th>Monodisciplinario</th>
            <th>Convivencia</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <p style="display:none">{{$i = 0}}</p>
          @foreach($budget_by_cohort_mult as $bbt)

          <tr>
            <td>{{ $bbt->cohort }}</td>
            <td style="text-align:right;">Q. {{ number_format($bbt->budget,2) }}</td>

            @if(sizeof($budget_by_cohort_mono) <= $i)
              <td style="text-align:right;">Q. 0.00</td>
            @else
              <td style="text-align:right;">Q. {{ number_format($budget_by_cohort_mono[$i]->budget,2) }}</td>
            @endif

            @if(sizeof($budget_by_cohort_conv) <= $i)
              <td style="text-align:right;">Q. 0.00</td>
            @else
              <td style="text-align:right;">Q. {{ number_format($budget_by_cohort_conv[$i]->budget,2) }}</td>
            @endif

            @if(sizeof($budget_by_cohort_total) <= $i)
              <td style="text-align:right;">Q. 0.00</td>
            @else
              <td style="text-align:right;">Q. {{ number_format($budget_by_cohort_total[$i]->budget,2) }}</td>
            @endif
          </tr>
          <p style="display:none">{{$i = $i+1}}</p>
          @endforeach

          <tr>
            <td class="color-blue" style="font-size:16px;">Total</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_mult,2) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_mono,2) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_conv,2) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_pjs,2) }}</td>
          </tr>
        </tbody>
      </table>
      En base a los proyectos registrados en la plataforma MiE 2.0
    </div>


		<h2>Aporte económico por disciplina*</h2>
		<div style="margin-bottom: 60px;">
		<div>
      <table class="table" style="width:100%">
        <thead>
					<tr>
						<th>Disciplina</th>
            <th>Aporte</th>
          </tr>
        </thead>
        <tbody>
					@foreach($budget_by_career as $bbc)

          <tr>
						<td>{{ $bbc->career }}</td>
						<td style="text-align:right;">Q. {{ number_format($bbc->bud_career,2) }}</td>
          </tr>

					@endforeach

					<tr>
						<td class="color-blue" style="font-size:16px;">Total</td>
						<td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_mono,2) }}</td>
          </tr>
        </tbody>
      </table>
			<p style="text-align: center; margin-top:0px; padding-top:0px">*Esta tabla sólo considera los proyectos monodisciplinarios registrados en la plataforma MiE 2.0</p>
    </div>
  </div>


	<h2>Usuarios beneficiados</h2>
  <div style="margin-bottom: 70px;">
  <h1>{{ number_format($total_direct_users + $total_indirect_users) }}</h1>
  <p style="text-align: center; margin-top:0px; padding-top:0px">Total usuarios beneficiados</p>

  <table class="table" style="width:100%">
    <thead>
      <tr>
        <th>Usuarios Directos</th>
        <th>Usuarios Indirectos</th>
      </tr>
    </thead>
    <tbody>
      <tr class="numbers">
          <td class="color-blue">{{ number_format($total_direct_users) }}</td>
          <td class="color-orange">{{ number_format($total_indirect_users) }}</td>
      </tr>
    </tbody>
  </table>

  <div>
    <table class="table " style="width:100%">

      <thead>
        <tr>
          <th>Tipo de proyecto</th>
          <th>Usuarios Directos</th>
          <th>Usuarios Indirectos</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users_by_ptype as $ubt)

        <tr>
          <td>{{ $ubt->type }}</td>
          <td style="text-align:right;">{{ number_format($ubt->directs) }}</td>
          <td style="text-align:right;">{{ number_format($ubt->indirects) }}</td>
          <td style="text-align:right;">{{ number_format($ubt->indirects + $ubt->directs) }}</td>
        </tr>

        @endforeach

        <tr>
          <td class="color-blue" style="font-size:16px;">Total</td>
          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_direct_users) }}</td>
          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_indirect_users) }}</td>
          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_direct_users + $total_indirect_users) }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  </div>

  <h2>Proyectos por número de beneficiarios (top 10)</h2></br>
  <div style="margin-bottom:30px;">
    <table class="table " style="width:100%">

      <thead>
        <tr>
          <th>Proyecto</th>
          <th>Tipo</th>
          <th>Aporte</th>
          <th>Usuarios Directos</th>
          <th>Usuarios Indirectos</th>
          <th>Total usuarios beneficiados</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pjs_top as $top)

        <tr>
          <td style="max-width:300px;">{{ substr($top->name,0,60) }}... <a href="{{url('gotoproject/'.$top->id.'/'.$top->team.'/'.$top->cohort.'/'.$top->type)}}">Ir al proyecto</a></td>
          <td>{{ $top->type }}</td>
          <td style="text-align:right;">Q. {{ number_format($top->budget,2) }}</td>
          <td style="text-align:right;">{{ number_format($top->du) }}</td>
          <td style="text-align:right;">{{ number_format($top->iu) }}</td>
          <td style="text-align:right;">{{ number_format($top->du + $top->iu) }}</td>
        </tr>

        @endforeach


      </tbody>
    </table>
  </div>
  La tabla muestra sólo los proyectos para los cuales se registró la ficha final, en donde se indican los usuarios directos e indirectos.


  <h2>Proyectos con mayor aporte económico (top 10)</h2></br>
  <div>
    <table class="table " style="width:100%;margin-bottom:30px;">
      <thead>
        <tr>
          <th>Proyecto</th>
          <th>Tipo</th>
          <th>Aporte</th>
          <th>Usuarios Directos</th>
          <th>Usuarios Indirectos</th>
          <th>Total usuarios beneficiados</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pjs_budget_top as $top)

        <tr>
          <td style="max-width:300px;">{{ substr($top->name,0,60) }}... <a href="{{url('gotoproject/'.$top->id.'/'.$top->team.'/'.$top->cohort.'/'.$top->type)}}">Ir al proyecto</a></td>
          <td>{{ $top->type }}</td>
          <td style="text-align:right;">Q. {{ number_format($top->budget,2) }}</td>
          <td style="text-align:right;">{{ number_format($top->du) }}</td>
          <td style="text-align:right;">{{ number_format($top->iu) }}</td>
          <td style="text-align:right;">{{ number_format($top->du + $top->iu) }}</td>
        </tr>

        @endforeach


      </tbody>
    </table>
    La tabla muestra sólo los proyectos para los cuales se registró la ficha final, en donde se indican los usuarios directos e indirectos.
  </div>


		<!--Catalogo de proyectos -->

		<div>

      <table class="table" style="width:100%">
        <thead>
					<tr>
            <th colspan="5"><h2>Proyectos ejecutados - EPSUM</h2></th>
          </tr>
        </thead>
        <tbody>
					@foreach($pjs as $d)

					<tr style="background-color:#f5f5dc; width:100%">
            <th colspan="5">{{ $d->name }}</th>
          </tr>

					<tr>
            <th>TIPO</th>
            <th>EQUIPO</th>
            <th>COHORTE</th>
            <th>LINEA</th>
						<th>VALOR</th>
          </tr>

          <tr>
						<td>{{ $d->type }}</td>
						<td>{{ $d->team }}</td>
						<td>{{ substr($d->cohort,0,1) }} C - {{ substr($d->cohort, 10) }}</td>
						<td>{{ substr($d->line,0,35) }}...</td>
						<!--
						@if($d->status == 0)
							<td><span class="label label-primary">Finalizado</span></td>
						@else
							<td><span class="label label-error">En ejecucón</span></td>
						@endif
						-->
						<td>Q. {{ $d->budget }}</td>
          </tr>

					<tr>
            <th colspan="5" style="background-color:#fff; color:#fff; font-size:14px">-</th>
          </tr>
					@endforeach
        </tbody>
      </table>
    </div>


  </div>


	<script type="text/javascript">
	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
				labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
				datasets: [{
						label: '# of Votes',
						data: [12, 19, 3, 5, 2, 3],
						backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
						],
						borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
						],
						borderWidth: 1
				}]
		},
		options: {
				scales: {
						yAxes: [{
								ticks: {
										beginAtZero:true
								}
						}]
				}
		}
	});
	</script>
</body>
</html>
