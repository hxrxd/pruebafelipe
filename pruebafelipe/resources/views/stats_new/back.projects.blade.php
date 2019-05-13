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
      <meta property="og:title" content="MiE 2.0"/>
      <meta property="og:description" content="Sistema de gestión de información del Programa EPSUM-USAC"/>
      <meta property="og:image" content="{{asset('img/card-2.png')}}"/>

    <!-- Twitter Cards -->
      <meta name="twitter:card" content="summary_large_image"/>
      <meta name="twitter:title" content="MiE 2.0"/>
      <meta name="twitter:description" content="Sistema de gestión de información del Programa EPSUM-USAC"/>
      <meta name="twitter:image" content="{{asset('img/card-2.png')}}">

</head>

<body  class="">

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        <div>
          <div class="stats-header">
            <img src="{{asset('img/logoepsum-2.png')}}" alt="logo-epsum" width="100px" height="auto" style="padding-bottom:0; cursor: pointer;" onclick="">
            <p style="color:white;font-size:20px;font-weight:bold;margin-bottom:0px;">ESTADÍSTICAS</p>
            <p style="color:white;font-size:12px;margin-top:0px;">EPSUM</p>
          </div>
          <div class="stats-menu">


            <a href="" class="btn btn-primary stats-button" style="margin-top:200px;" > Estudiantes </a>
            <a href="" class="btn btn-primary stats-button" > Financiamiento </a>
            <a href="" class="btn btn-primary stats-button"> Equipos </a>
            <a href="" class="btn btn-primary stats-button"> Diagnósticos </a>
            <a href="" class="btn btn-primary stats-button"> Proyectos </a>
            <hr style="border-color:#ffffff22">
            <a href="{{url('map/')}}" class="btn btn-primary stats-button"> Ir a Geoportal </a>
            <a href="{{url('login/')}}" class="btn btn-primary stats-button"> Ir a MiE 2.0 </a>

            <div style="padding:40px;font-size:12px;color:white;margin-top:25px;">
              <p style="font-weight:bold;margin-bottom:0px;">EPSUM 2018</p>
              <p style="margin-top:0px;color:#2ebeef"><a>Más información</a></p>
            </div>

          </div>
        </div>


        <!-- Page wraper -->
        <div id="page-wrapper" style="background-color:white">
          <div class="wrapper wrapper-content animated fadeInRight">

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Proyectos</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>


		<h2>Resumen de Proyectos</h2>
		<div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
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
              <td class="color-blue">{{ $total_mult }} ({{number_format($total_mult*100/$total_pjs)}}%)</td>
              <td class="color-red">{{ $total_conv }} ({{number_format($total_mono*100/$total_pjs)}}%)</td>
              <td class="color-orange">{{ $total_mono }} ({{number_format($total_conv*100/$total_pjs)}}%)</td>
          </tr>
        </tbody>
      </table>
		</div>

		<div style="margin-bottom: 20px;">
			<table class="table" style="width:100%">
        <thead>
					<tr>
            <th>Área</th>
            <th>Línea de Intervención</th>
            <th>Proyectos</th>
						<th>% por línea</th>
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
              <td colspan="2" style="font-size:16px;">Total</td>
              <td style="text-align:right; font-weight:bold; font-size:16px;">{{ $total_pjs }}</td>
							<td style="text-align:right; font-weight:bold; font-size:16px;">100%</td>
          </tr>
        </tbody>
      </table>

		</div>


    <div class="row" style="padding-top:40px;padding-bottom:40px">
      <h2>Porcentaje de proyectos por línea de intervención</h2></br>
  		<div>
        <div style="margin-top:25px;height:400px">
          <div class="col-sm-4">
            <label class="container chk-mult">Multidisciplinarios
              <input type="radio" checked="checked" name="radio">
              <span class="checkmark"></span>
            </label>
            <label class="container chk-mono">Monodisciplinarios
              <input type="radio" name="radio">
              <span class="checkmark"></span>
            </label>
            <label class="container chk-conv">Convivencia
              <input type="radio" name="radio">
              <span class="checkmark"></span>
            </label>
            <div class="custom-legend">
              <h5 id="total-res">Total General:<br><strong>{{$total_pjs}} proyectos</strong></h5>
              <h5 id="partial-res">Multidisciplinarios: <br><strong>{{$total_mult}} proyectos</strong></h5>
              <h5 id="partial-per">Porcentaje del total: <br><strong>{{number_format($total_mult*100/$total_pjs,2)}} %</strong></h5>
            </div>

          </div>
          <div id="chartBox" class="col-sm-8">
            <canvas id="chart1" width="200" height="100"></canvas>
          </div>

        </div>
      </div>
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
              <td class="color-blue">Q. {{ number_format($budget_mult,2) }} ({{number_format($budget_mult*100/$budget_pjs)}}%)</td>
              <td class="color-red">Q. {{ number_format($budget_conv,2) }} ({{number_format($budget_conv*100/$budget_pjs)}}%)</td>
              <td class="color-orange">Q. {{ number_format($budget_mono,2) }} ({{number_format($budget_mono*100/$budget_pjs)}}%)</td>
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

    <h2>Aporte económico de proyectos por cohorte</h2></br>
    <div id="chartBox2" class="col-sm-12" style="margin-bottom:60px;">
      <canvas id="chart2" width="200" height="75"></canvas>
    </div>


		<h2>Aporte económico de proyectos por disciplina*</h2>
    <div style="margin-bottom: 20px;">
      <table class="table" style="width:100%">
        <thead>
          <tr>
            <th>Monodisciplinarios</th>
            <th>{{$budget_by_career[0]->career}}</th>
            <th>{{$budget_by_career[1]->career}}</th>
            <th>{{$budget_by_career[2]->career}}</th>
          </tr>
        </thead>
        <tbody>
          <tr class="numbers">
              <td class="color-blue">Q. {{ number_format($budget_mono,2) }}</td>
              <td class="color-indico">Q. {{ number_format($budget_by_career[0]->bud_career,2) }} ({{ number_format($budget_by_career[0]->bud_career * 100 / $budget_mono) }}%)</td>
              <td class="color-blue">Q. {{ number_format($budget_by_career[1]->bud_career,2) }} ({{ number_format($budget_by_career[1]->bud_career * 100 / $budget_mono) }}%)</td>
              <td class="color-orange">Q. {{ number_format($budget_by_career[2]->bud_career,2) }} ({{ number_format($budget_by_career[2]->bud_career * 100 / $budget_mono) }}%)</td>
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
            <!--<th>Número de proyectos</th>-->
            <th>Aporte</th>
            <th>% de Total  del Aporte Mono.</th>
          </tr>
        </thead>
        <tbody>
					@foreach($budget_by_career as $bbc)

          <tr>
						<td>{{ $bbc->career }}</td>
            <!--<td style="text-align:right;">{{ number_format($bbc->projs) }}</td>-->
						<td style="text-align:right;">Q. {{ number_format($bbc->bud_career,2) }}</td>
            <td style="text-align:right;">{{ number_format(($bbc->bud_career*100/$budget_mono),2) }}%</td>
          </tr>

					@endforeach

					<tr>
						<td class="color-blue" style="font-size:16px;">Total</td>
						<td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_mono,2) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">100%</td>
          </tr>
        </tbody>
      </table>
			<p style="text-align: center; margin-top:0px; padding-top:0px">*Esta tabla sólo considera los proyectos monodisciplinarios registrados en la plataforma MiE 2.0</p>
    </div>
  </div>

  <h2>Aporte económico por disciplina</h2></br>
  <div id="chartBox3" class="col-sm-12" style="margin-bottom:70px;">
    <canvas id="chart3" width="200" height="125"></canvas>
  </div>

  <h2>Aporte económico de proyectos por Unidad Académica</h2>
  <div style="margin-bottom: 20px;">
    <table class="table" style="width:100%">
      <thead>
        <tr>
          <th>Total</th>
          <th>{{$budget_by_au[0]->au}}</th>
          <th>{{$budget_by_au[1]->au}}</th>
          <th>{{$budget_by_au[2]->au}}</th>
        </tr>
      </thead>
      <tbody>
        <tr class="numbers">
            <td class="color-blue">Q. {{ number_format($budget_pjs,2) }}</td>
            <td class="color-indico">Q. {{ number_format($budget_by_au[0]->bud_au,2) }} ({{ number_format($budget_by_au[0]->bud_au * 100 / $budget_pjs) }}%)</td>
            <td class="color-blue">Q. {{ number_format($budget_by_au[1]->bud_au,2) }} ({{ number_format($budget_by_au[1]->bud_au * 100 / $budget_pjs) }}%)</td>
            <td class="color-orange">Q. {{ number_format($budget_by_au[2]->bud_au,2) }} ({{ number_format($budget_by_au[2]->bud_au * 100 / $budget_pjs) }}%)</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-bottom: 60px;">
    <div>
      <table class="table" style="width:100%">
        <thead>
          <tr>
            <th>Unidad Académica</th>
            <th>Número de proyectos</th>
            <th>Aporte</th>
            <th>% del Aporte Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($budget_by_au as $bba)

          <tr>
            <td>{{ $bba->au }}</td>
            <td style="text-align:right;">{{ number_format($bba->projs) }}</td>
            <td style="text-align:right;">Q. {{ number_format($bba->bud_au,2) }}</td>
            <td style="text-align:right;">{{ number_format(($bba->bud_au*100/$budget_pjs),2) }}%</td>
          </tr>

          @endforeach

          <tr>
            <td class="color-blue" style="font-size:16px;">Total</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_pjs) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_pjs,2) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">100%</td>
          </tr>
        </tbody>
      </table>
      <p style="text-align: center; margin-top:0px; padding-top:0px">Esta tabla sólo considera los proyectos registrados en la plataforma MiE 2.0</p>
    </div>
  </div>

  <div class="row" style="padding-top:40px;padding-bottom:40px">
    <h2>Porcentaje de aporte por unidad académica</h2></br>
    <div>
      <div style="margin-top:25px;height:400px">
        <div class="col-sm-4">
          <label class="container chk-mult-2">Multidisciplinarios
            <input type="radio" checked="checked" name="radio2">
            <span class="checkmark"></span>
          </label>
          <label class="container chk-mono-2">Monodisciplinarios
            <input type="radio" name="radio2">
            <span class="checkmark"></span>
          </label>
          <label class="container chk-conv-2">Convivencia
            <input type="radio" name="radio2">
            <span class="checkmark"></span>
          </label>
          <div class="custom-legend">
            <h5 id="total-res-1">Total General:<br><strong>Q. {{number_format($budget_pjs,2)}}</strong></h5>
            <h5 id="partial-res-1">Multidisciplinarios: <br><strong>Q. {{number_format($budget_mult,2)}}</strong></h5>
            <h5 id="partial-per-1">Porcentaje del total: <br><strong>{{number_format($budget_mult*100/$budget_pjs,2)}} %</strong></h5>
          </div>

        </div>
        <div id="chartBox5" class="col-sm-8">
          <canvas id="chart5" width="200" height="100"></canvas>
        </div>

      </div>
    </div>
  </div>


  <h2>Aporte económico de proyectos por equipo</h2>
  <div style="margin-bottom: 20px;">
    <table class="table" style="width:100%">
      <thead>
        <tr>
          <th>Total</th>
          <th>{{$budget_by_team[0]->team}}</th>
          <th>{{$budget_by_team[1]->team}}</th>
          <th>{{$budget_by_team[2]->team}}</th>
        </tr>
      </thead>
      <tbody>
        <tr class="numbers">
            <td class="color-blue">Q. {{ number_format($budget_pjs,2) }}</td>
            <td class="color-indico">Q. {{ number_format($budget_by_team[0]->bud_team,2) }} ({{ number_format($budget_by_team[0]->bud_team * 100 / $budget_pjs) }}%)</td>
            <td class="color-blue">Q. {{ number_format($budget_by_team[1]->bud_team,2) }} ({{ number_format($budget_by_team[1]->bud_team * 100 / $budget_pjs) }}%)</td>
            <td class="color-orange">Q. {{ number_format($budget_by_team[2]->bud_team,2) }} ({{ number_format($budget_by_team[2]->bud_team * 100 / $budget_pjs) }}%)</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-bottom: 60px;">
    <div>
      <table class="table" style="width:100%">
        <thead>
          <tr>
            <th>Equipo</th>
            <th>Número de proyectos</th>
            <th>Aporte</th>
            <th>% del Aporte Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($budget_by_team as $bba)

          <tr>
            <td>{{ $bba->team }}</td>
            <td style="text-align:right;">{{ number_format($bba->projs) }}</td>
            <td style="text-align:right;">Q. {{ number_format($bba->bud_team,2) }}</td>
            <td style="text-align:right;">{{ number_format(($bba->bud_team*100/$budget_pjs),2) }}%</td>
          </tr>

          @endforeach

          <tr>
            <td class="color-blue" style="font-size:16px;">Total</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_pjs) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">Q. {{ number_format($budget_pjs,2) }}</td>
            <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">100%</td>
          </tr>
        </tbody>
      </table>
      <p style="text-align: center; margin-top:0px; padding-top:0px">Esta tabla sólo considera los proyectos registrados en la plataforma MiE 2.0</p>
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
          <td class="color-blue">{{ number_format($total_direct_users) }} ({{number_format($total_direct_users*100/($total_direct_users + $total_indirect_users))}}%)</td>
          <td class="color-orange">{{ number_format($total_indirect_users) }} ({{number_format($total_indirect_users*100/($total_direct_users + $total_indirect_users))}}%)</td>
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
          <th>% Usuarios Directos</th>
          <th>% Usuarios Indirectos</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users_by_ptype as $ubt)

        <tr>
          <td>{{ $ubt->type }}</td>
          <td style="text-align:right;">{{ number_format($ubt->directs) }}</td>
          <td style="text-align:right;">{{ number_format($ubt->indirects) }}</td>
          <td style="text-align:right;">{{ number_format($ubt->indirects + $ubt->directs) }}</td>
          <td style="text-align:right;">{{ number_format($ubt->directs*100/($ubt->indirects + $ubt->directs),2) }}%</td>
          <td style="text-align:right;">{{ number_format($ubt->indirects*100/($ubt->indirects + $ubt->directs),2) }}%</td>
        </tr>

        @endforeach

        <tr>
          <td class="color-blue" style="font-size:16px;">Total</td>
          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_direct_users) }}</td>
          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_indirect_users) }}</td>
          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_direct_users + $total_indirect_users) }}</td>
          <td class="color-blue" style="font-size:16px;"></td>
          <td class="color-blue" style="font-size:16px;"></td>
        </tr>
      </tbody>
    </table>
  </div>

  </div>

  <h2>Proyectos por número de beneficiarios (top 10)</h2></br>
  <div>
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

  <div class="row" style="padding-top:40px;margin-bottom:40px">

    <h2>Proyectos por tipo con mayor número de usuarios directos</h2></br>
    <div>

      <div style="margin-top:25px;height:400px">
        <div class="col-sm-4">
          <label class="container chk-mult-1">Multidisciplinarios
            <input type="radio" checked="checked" name="radio1">
            <span class="checkmark"></span>
          </label>
          <label class="container chk-mono-1">Monodisciplinarios
            <input type="radio" name="radio1">
            <span class="checkmark"></span>
          </label>
          <label class="container chk-conv-1">Convivencia
            <input type="radio" name="radio1">
            <span class="checkmark"></span>
          </label>


        </div>
        <div id="chartBox4" class="col-sm-8">
          <canvas id="chart4" width="200" height="100"></canvas>
        </div>
      </div>
    </div>
  </div>

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

  </br>

  <div style="margin-top:25px;">
    <a onclick="loadingReportPDF()" href="{{url('reprojects/')}}" class="btn btn-primary" style="margin:auto"><i class="fa fa-external-link"></i> Generar Reporte PDF </a>
  </div>

	<!--Catalogo de proyectos -->
  <!--<div>

    <h2>Catálogo de proyectos</h2>
		<div>

      <table class="table table-bordered" style="width:100%">
        <thead>

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
						<td>Q. {{ $d->budget }}</td>
          </tr>

					<tr>
            <th colspan="5" style="background-color:#fff; color:#fff; font-size:14px">-</th>
          </tr>
					@endforeach
        </tbody>
      </table>
    </div>


  </div>-->

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
          <p>Las cifras mostradas en el siguiente reporte corresponden a los datos registrados por los estudiantes en la plataforma MiE 2.0, específicamente en el apartado de Registro de Proyectos. El sistema se basa en dichos datos tal cual se encuentran en la base de datos para procesarlos en forma de tablas y gráficas, por tal razón, se debe tomar en cuenta este aviso en el caso de que la información no sea correcta.</p>
          <p><strong>Reportes de EPSUM aún está en desarrollo, por lo que pueden existir cambios en la distribución de información sin previo aviso.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">¡Entendido!</button>
        </div>
      </div>
    </div>
  </div>

</div>


<!-- Footer -->
@include('template/footer')
</div>
</div>

@include('template/scripts')



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
    updateChartBudgetByAU(init_type);
  });

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      //document.getElementById("frame").style.display = "block";
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
  						label: 'Proyectos por Línea de Intervención',
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


  // FOR UPDATE CHART BUDGET BY AU

  function updateChartBudgetByAU(type_project_by_au){
    $.ajax({
  		url: '{{asset("/stats/chart/budget/au/type")}}'.replace('type',type_project_by_au),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var lines= [];
  			var vals = [];
        //shuffle(gamma);

  			for(var i in data) {
  				lines.push(data[i].au);
  				vals.push(data[i].budget);
  			}

  			var chartdata = {
  				labels: lines,
  				datasets : [
  					{
  						label: 'Aporte por unidad académica',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx5 = document.getElementById('chart5').getContext('2d');

  			var chart_budget_by_au = new Chart(ctx5, {
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
            },

            /*tooltips: {
              mode: 'index',
              intersect: false,
            },*/
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

  // CHECKS PROJECT TYPE BY LINE

  $(document).ready(function () {
      $('.chk-mult').click(function(){
          //chart_projects_by_line.destroy();
          $('#chart1').remove();
          $('#chartBox').append('<canvas id="chart1" width="200" height="100"></canvas>');
          updateChartProjectTypeByLine("Multidisciplinario");
          $('#partial-res').html("<h5 id='partial-res'>Multidisciplinarios: <br><strong>{{$total_mult}} proyectos</strong></h5>");
          $('#partial-per').html("<h5 id='partial-per'>Porcentaje del total: <br><strong>{{number_format($total_mult*100/$total_pjs,2)}} %</strong></h5>");
      });

      $('.chk-mono').click(function(){
          $('#chart1').remove();
          $('#chartBox').append('<canvas id="chart1" width="200" height="100"></canvas>');
          updateChartProjectTypeByLine("Monodisciplinario");
          $('#partial-res').html("<h5 id='partial-res'>Monodisciplinarios: <br><strong>{{$total_mono}} proyectos</strong></h5>");
          $('#partial-per').html("<h5 id='partial-per'>Porcentaje del total: <br><strong>{{number_format($total_mono*100/$total_pjs,2)}} %</strong></h5>");
      });

      $('.chk-conv').click(function(){
          $('#chart1').remove();
          $('#chartBox').append('<canvas id="chart1" width="200" height="100"></canvas>');
          updateChartProjectTypeByLine("Convivencia");
          $('#partial-res').html("<h5 id='partial-res'>Convivencia: <br><strong>{{$total_conv}} proyectos</strong></h5>");
          $('#partial-per').html("<h5 id='partial-per'>Porcentaje del total: <br><strong>{{number_format($total_conv*100/$total_pjs,2)}} %</strong></h5>");
      });
  });


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


  // CHECKS BUDGET BY AU

  $(document).ready(function () {
      $('.chk-mult-2').click(function(){
          //chart_projects_by_line.destroy();
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          updateChartBudgetByAU("Multidisciplinario");

          $('#partial-res-1').html("<h5 id='partial-res-1'>Multidisciplinarios: <br><strong>Q {{number_format($budget_mult,2)}}</strong></h5>");
          $('#partial-per-1').html("<h5 id='partial-per-1'>Porcentaje del total: <br><strong>{{number_format($budget_mult*100/$budget_pjs,2)}} %</strong></h5>");
      });

      $('.chk-mono-2').click(function(){
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          updateChartBudgetByAU("Monodisciplinario");

          $('#partial-res-1').html("<h5 id='partial-res-1'>Monodisciplinarios: <br><strong>Q {{number_format($budget_mono,2)}}</strong></h5>");
          $('#partial-per-1').html("<h5 id='partial-per-1'>Porcentaje del total: <br><strong>{{number_format($budget_mono*100/$budget_pjs,2)}} %</strong></h5>");
      });

      $('.chk-conv-2').click(function(){
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          updateChartBudgetByAU("Convivencia");

          $('#partial-res-1').html("<h5 id='partial-res-1'>Convivencia: <br><strong>Q {{number_format($budget_conv,2)}}</strong></h5>");
          $('#partial-per-1').html("<h5 id='partial-per-1'>Porcentaje del total: <br><strong>{{number_format($budget_conv*100/$budget_pjs,2)}} %</strong></h5>");
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

</body>
</html>
