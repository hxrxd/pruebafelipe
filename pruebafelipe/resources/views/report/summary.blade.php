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
    <h1>Proyecto {{Session::get('pj')->type}}</h1>
    <h3>Equipo: {{$team->name}}, {{Session::get('pj')->cohort}}<br>{{$municipality->municipality}}, {{$department->departament}}</h3>
    <h3></h3>

    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="subtitle">Nombre</td>
            <td><p>{{Session::get('pj')->name}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Ubicación</td>
            <td><p>{{Session::get('pj')->location}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Objetivo General</td>
            <td><p>{{Session::get('pj')->objective}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Objetivos Específicos</td>
            <td>
              @foreach ($allWorkplans as $wp)
                <p>• {{$wp->objective_what}}</p>
              @endforeach
            </td>
          </tr>
          <tr>
            <td class="subtitle">Desarrollo Metodológico</td>
            <td><p>{{$final->methodology}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Línea de Intervención</td>
            <td>{{$line->name}}</td>
          </tr>
          <tr>
            <td class="subtitle">Área de intervención</td>
            <td><p>{{$line->area}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Políticas asociadas</td>
            <td><p>{{$line->policy}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Metas</td>
            <td>
              @foreach ($allWorkplans as $wp)
                <p>• {{$wp->objective_what_for}}</p>
              @endforeach
            </td>
          </tr>
          <tr>
            <td class="subtitle">Usuarios directos</td>
            <td><p>{{$final->direct_users}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Usuarios indirectos</td>
            <td><p>{{$final->indirect_users}}</p></td>
          </tr>
          <tr>
            <td class="subtitle">Aporte económico técnico al proyecto</td>
            <td><p>Q.{{Session::get('pj')->budget}}</p></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>



</body>
</html>
