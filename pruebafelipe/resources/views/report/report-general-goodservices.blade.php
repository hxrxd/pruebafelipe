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
      @if($typeReport==0)
        <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
          <thead>
            <tr>
              <th>Total de bienes y servicios</th>
              @if(count($bsGeneral)==1)
                <th> {{$bsGeneral[0]->rls}} </th>
              @elseif(count($bsGeneral)==2)
                <th> {{$bsGeneral[0]->rls}} </th>
                <th> {{$bsGeneral[1]->rls}} </th>
              @else
                <th> {{$bsGeneral[0]->rls}} </th>
                <th> {{$bsGeneral[1]->rls}} </th>
                <th> {{$bsGeneral[2]->rls}} </th>
              @endif
            </tr>
          </thead>
          <tbody>
            <tr class='numbers'>
              @if(count($bsGeneral)==1)
                <td class='color-blue'> {{number_format($totalBS[0]->amount)}} </td>
                <td class='color-indico'> {{number_format($bsGeneral[0]->amount)}} ({{number_format($bsGeneral[0]->amount * 100 / $totalBS[0]->amount)}}%) </td>
              @elseif(count($bsGeneral)==2)
                <td class='color-blue'> {{number_format($totalBS[0]->amount)}} </td>
                <td class='color-indico'> {{number_format($bsGeneral[0]->amount)}} ({{number_format($bsGeneral[0]->amount * 100 / $totalBS[0]->amount)}}%) </td>
                <td class='color-blue'> {{number_format($bsGeneral[1]->amount)}} ({{number_format($bsGeneral[1]->amount * 100 / $totalBS[0]->amount)}}%) </td>
              @else
                <td class='color-blue'> {{number_format($totalBS[0]->amount)}} </td>
                <td class='color-indico'> {{number_format($bsGeneral[0]->amount)}} ({{number_format($bsGeneral[0]->amount * 100 / $totalBS[0]->amount)}}%) </td>
                <td class='color-blue'> {{number_format($bsGeneral[1]->amount)}} ({{number_format($bsGeneral[1]->amount * 100 / $totalBS[0]->amount)}}%) </td>
                <td class='color-orange'> {{number_format($bsGeneral[2]->amount)}} ({{number_format($bsGeneral[2]->amount * 100 / $totalBS[0]->amount)}}%) </td>
              @endif
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered" style="width:100%; margin-bottom:40px;">
          <thead>
            <tr>
              <th>Bien y Servicio</th>
              <th style="text-align:right;">Cantidad</th>
              <th style="text-align:right;">%</th>
            </tr>
          </thead>
          <tbody>
            @foreach($bsGeneral as $sba)
              <tr>
                <td> {{$sba->rls}}</td>
                <td style="text-align:right;"> {{number_format($sba->amount)}}</td>
                <td style="text-align:right;"> {{number_format($sba->amount * 100 / $totalBS[0]->amount,2)}}%</td>
              </tr>
            @endforeach
              <tr>
                <td class="color-blue" style="font-size:16px;">Total</td>                                
                <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"> {{number_format($totalBS[0]->amount)}}</td>
                <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
              </tr>
          </tbody>
        </table>
      
      @else
        <?php 
          $cant = 0;
          $tableOne='';
            foreach($bsGeneral as $sba){
                          if ($sba->rls == 'Otro') { 
                              # code...
                              $nameR = '';
                          } else {
                              # code...
                              $nameR = $sba->rls;
                          }
                          
                          $tableOne = $tableOne . '
                              <tr>
                              <td>'. $nameR.' '.$sba->dscrsl.'</td>
                              <td style="text-align:left;">'. number_format($sba->amount).'</td>
                              <td style="text-align:left;">'. $sba->obj.'</td>
                              <td style="text-align:left;">'. $sba->linea .'</td>
                              <td style="text-align:left;">'. $sba->area .'</td>
                              <td style="text-align:left;">'. $sba->politica .'</td>
                              <td style="text-align:left;">'. $sba->ods .'</td>
                              </tr>
                          ';
                          $cant = $sba->amount + $cant;
            }
       ?>
      <table class="table table-bordered" style="width:100%; margin-bottom:20px;">
          <thead>
            <tr>
              <th><center> Total de bienes y servicios {{$bsGeneral[0]->rls}}</center></th>
            </tr>
          </thead>
          <tbody>
            <tr class='numbers'>
              <td><center> {{number_format($cant)}} </center></td>
            </tr>
          </tbody>
        </table>
       <div style='align:center;'> 
        <table class="table table-bordered" style="width:100%; margin-bottom:20px;">
          <thead>
            <tr>
              <th>Bien y Servicio</th>
              <th style="text-align:right;">Cantidad</th>
              <th style="text-align:right;">Objetivo</th>
              <th style="text-align:right;">Línea de Intervención</th>
              <th style="text-align:right;">Área</th>
              <th style="text-align:right;">Política Pública</th>
              <th style="text-align:right;">ODS</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $tableOne ?>
          </tbody>
        </table>
        </div>
      @endif
      
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
