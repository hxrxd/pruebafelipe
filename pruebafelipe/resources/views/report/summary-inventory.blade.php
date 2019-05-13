<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>EPSUM - Inventario</title>
<style>
	h1{
		text-align: center;
		text-transform: uppercase;
    margin-bottom: 0px;
	}
  h3,h4{
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
    width: 99%;
    margin: 0 auto;
    margin-bottom: 50px;
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
      <img src="img/logo_usac.png" alt="logo-usac" width="auto" height="5%" style="padding-bottom:0; float:right;">
      <img src="img/logo_epsum.png" alt="logo-epsum" width="auto" height="5%" style="padding-bottom:0; float:left;">
      <h4><h3>Programa EPSUM</h3>Centro Cultural Universitario, segundo nivel, ala Sur. 2da. avenida 12-40 Zona 1, Guatemala </h4>

    </div>
    <h1 style="margin-bottom:50px">Reporte de General de Inventario</h1>
    <h3></h3>

    <div>
      <table class="table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>FECHA APERTURA</th>
            <th>NO. DE INVENTARIO</th>
            <th>NO. TARJETA RESP</th>
            <th>DESCRIPCIÓN DEL BIEN</th>
            <th>VALOR</th>
            <th>OBSERVACIONES</th>
          </tr>
        </thead>
        <tbody>

          @foreach($inventory as $inv)

          <tr>
              <td>{{ $inv->open_date }}</td>
              <td>{{ $inv->inv_number }}</td>
              <td>{{ $inv->resp_target_number }}</td>
              <td>{{ $inv->description }}</td>
              <td>{{ $inv->cost }}</td>
              <td>{{ $inv->observations }}</td>
          </tr>


          @endforeach

        </tbody>
      </table>
    </div>
  </div>



</body>
</html>
