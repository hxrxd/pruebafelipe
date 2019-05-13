<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ficha de Resultados</title>
<style>
	h1{
		text-align: center;
		text-transform: uppercase;
    margin-bottom: 0px;
	}
  h3{
    text-align: center;
		text-transform: uppercase;
    margin-bottom: 0px;
  }
  p{
    text-align : justify;
  }

  tr:nth-child(even){
    background-color: #f5f5dc;
  }
  th, td {
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
  .title{
    font-weight: bold;
    font-size: 18px;
  }
  .logos{
    width: 60%;
    margin: 0 auto;
  }
	#segundo{
		color:#44a359;
	}
	#tercero{
		text-decoration:line-through;
	}
</style>
</head>
<body>

  <div class="frame">
    <div class="logos">
      <img src="img/logo_vice.png" alt="logo-vice" width="auto" height="5%" style="padding-bottom:0; cursor: pointer;">
      <img src="img/logo_usac.png" alt="logo-usac" width="auto" height="5%" style="padding-bottom:0; cursor: pointer;">
      <img src="img/logo_epsum.png" alt="logo-epsum" width="auto" height="5%" style="padding-bottom:0; cursor: pointer;">
    </div>
    <h1>Informe Diagnóstico</h1>
    <h3>{{$municipality->municipality}}, {{$department->departament}}</h3>
    <h3 style="margin-bottom:40px;">Equipo: {{$tm->name}}, {{$cohort_str}}</h3>

    <div>
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <thead>
          <tr>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!--INTRODUCCIÓN-->
          <tr>
            <td class="title">Introducción</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Introducción</td>
            <td><p>{{$dxr[0]->introduction}}</p></td>
          </tr>
        </tbody>
      </table>
          <!--TERRITORIO-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Territorio de intervención</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Lugar</td>
            <td><p>{{$dxr[0]->name}}</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Ubicación</td>
            <td><p>{{$dxr[0]->location}}</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">MSNM (metros sobre el nivel del mar)</td>
            <td><p>{{$dxr[0]->masl}} m</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Superficie territorial</td>
            <td><p>{{$dxr[0]->surface}} km&sup2;</p></td>
          </tr>
        </tbody>
      </table>
          <!--DEMOGRAFÍA-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Demografía</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población de 0 a 14 años de edad</td>
            <td>{{$dxr[0]->population_0_to_14}} personas</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población de 15 a 64 años de edad</td>
            <td><p>{{$dxr[0]->population_15_to_64}} personas</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población de 65 años o más</td>
            <td><p>{{$dxr[0]->population_65_or_more}} personas</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población mujeres</td>
            <td><p>{{$dxr[0]->population_women}} mujeres</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población hombres</td>
            <td><p>{{$dxr[0]->population_men}} hombres</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población Rural</td>
            <td><p>{{$dxr[0]->population_rural}} habitantes</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población Urbana</td>
            <td><p>{{$dxr[0]->population_urban}} habitantes</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población Indígena</td>
            <td><p>{{$dxr[0]->population_indigenous}} habitantes</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población Garífuna</td>
            <td><p>{{$dxr[0]->population_garifuna}} habitantes</p></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Población Xinca</td>
            <td><p>{{$dxr[0]->population_xinca}} habitantes</p></td>
          </tr>
        </tbody>
      </table>
          <!--ECONOMÍA-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Economía</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Porcentaje de pobreza</td>
            <td>{{$dxr[0]->poverty}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Porcentaje de pobreza extrema</td>
            <td>{{$dxr[0]->poverty_extreme}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Total de ingreso por familia</td>
            <td>Q. {{$dxr[0]->income_per_family}}</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Observaciones</td>
            <td>{{$dxr[0]->observations}}</td>
          </tr>
        </tbody>
      </table>
          <!--SALUD-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Salud</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Tasa de acceso a atención primaria en salud</td>
            <td>{{$dxr[0]->rate_access_primary_health_care}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Tasa de enfermedades vinculadas al consumo de agua no apta y mala disposición de excretas</td>
            <td>{{$dxr[0]->rate_diseases_by_contaminated_water}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Tasa de desnutrición crónica en niños menores de 5 años</td>
            <td>{{$dxr[0]->rate_chronic_malnutrition}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Enfermedades frecuentes en niños menores de 5 años</td>
            <td>{{$dxr[0]->diseases}}</td>
          </tr>
        </tbody>
      </table>
          <!--EDUCACIÓN-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Educación</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle">Porcentaje de aprobación de pruebas de matemática</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Nivel Primario</td>
            <td>{{$dxr[0]->percentage_math_test_approval_primary}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Nivel Secundario</td>
            <td>{{$dxr[0]->percentage_math_test_approval_secondary}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Nivel Diversificado</td>
            <td>{{$dxr[0]->percentage_math_test_approval_diversified}} %</td>
          </tr>
          <tr>
            <td class="subtitle">Porcentaje de aprobación de pruebas de lectura</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Nivel Primario</td>
            <td>{{$dxr[0]->percentage_reading_test_approval_primary}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Nivel Secundario</td>
            <td>{{$dxr[0]->percentage_reading_test_approval_secondary}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Nivel Diversificado</td>
            <td>{{$dxr[0]->percentage_reading_test_approval_diversified}} %</td>
          </tr>
        </tbody>
      </table>
          <!--AMBIENTE-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Medio ambiente</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Tasa de cobertura forestal</td>
            <td>{{$dxr[0]->forest_cover_rate}} %</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Número de planes de gestión integral de desechos sólidos</td>
            <td>{{$dxr[0]->num_plans_integral_management_solid_waste}}</td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Porcentaje de uso de la tierra para tareas agrícolas</td>
            <td>{{$dxr[0]->land_use_rate}} %</td>
          </tr>
        </tbody>
      </table>
          <!--GESTION MUNICIPAL-->
      <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
        <tbody>
          <tr>
            <td class="title">Gestión municipal</td>
            <td></td>
          </tr>
          <tr>
            <td class="subtitle" style="width:40%">Índice de gestión municipal</td>
            <td>{{$dxr[0]->municipal_management_index}}</td>
          </tr>
        </tbody>
      </table>

			<div>
	      <img src="img/license-2.png" alt="logo-vice" width="auto" height="5%" style="padding-bottom:0; cursor: pointer;">
				<p><i>Este trabajo está protegido bajo una licencia internacional Creative Commons: Atribución - Uso No Comercial - Compartir Igual.</i></p>
				</br>
				<p><strong>Equipo Multidisciplinario</strong></p>
				@foreach ($participants as $p)
					<p style="width:auto">{{$p->fsurname.' '.$p->ssurname.', '.$p->name}}</p>
				@endforeach

				<p><strong>EPSUM {{substr($cohort_str, 10,15)}}</strong></p>
	    </div>
    </div>
  </div>



</body>
</html>
