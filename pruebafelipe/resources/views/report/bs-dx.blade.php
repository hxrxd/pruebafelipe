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
  h2{
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
    <h1>Estadísticas de EPSUM</h1>
    <h2>Bienes y Servicios</h2>
    <h3>¡IMPORTANTE! <br>
      <p>Las cifras mostradas en el siguiente reporte corresponden a los datos registrados en el Sistema MiE 2.0., por tal razón, se debe tomar en cuenta este aviso en el caso de que la información no sea correcta.</p>
      <p><strong>Reportes de EPSUM aún está en desarrollo, por lo que pueden existir cambios en la distribución de información sin previo aviso.</strong></p>
    </h3>
    <div>
    <div>
    {{$pdfBody}}
   
   </div>
<br><br>
			<div>
	      <img src="img/license-2.png" alt="logo-vice" width="auto" height="5%" style="padding-bottom:0; cursor: pointer;">
				<p><i>Este trabajo está protegido bajo una licencia internacional Creative Commons: Atribución - Uso No Comercial - Compartir Igual.</i></p>
				</br>
				
	    </div>
    </div>
  </div>
  


</body>
</html>
