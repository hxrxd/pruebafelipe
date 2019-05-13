<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>EPSUM - Proveedores</title>
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
    <h1 style="margin-bottom:50px">Reporte de Proveedores</h1>
    <h3></h3>

    <div>
      <table class="table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>NIT</th>
            <th>PROVEEDOR</th>
            <th>TELÉFONO</th>
            <th>CORREO</th>
          </tr>
        </thead>
        <tbody>

          @foreach($providers as $prov)

          <tr>
              <td>{{ $prov->nit }}</td>
              <td>{{ $prov->name }}</td>
              <td>{{ $prov->phone }}</td>
              <td>{{ $prov->email }}</td>
          </tr>


          @endforeach

        </tbody>
      </table>
    </div>
  </div>



</body>
</html>
