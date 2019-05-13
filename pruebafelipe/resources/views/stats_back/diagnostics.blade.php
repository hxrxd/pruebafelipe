@extends('admintemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Diagnósticos</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>

    <div class="color-orange" style="padding:15px;font-size:16px;border-radius:10px;">
      <p style="text-align:center;">El diagnóstico realizado por estudiantes es una investigación que siempre se está mejorando. Por tal razón, la información que se mostrará será de la última cohorte; en tanto, algunos datos podrían no ser correctos. Este mensaje será removido pronto.</p>
    </div>

    <div class="row m-t-sm tabs">
      <div class="col-lg-12">
        <div class="panel blank-panel">
          <div class="panel-heading">
            <div class="panel-options">
                <ul class="nav nav-tabs">
                    <li class="active tb"><a href="#tab-0" data-toggle="tab" style="font-size:18px;">Territorio</a></li>
                    <li class="tb"><a href="#tab-1" data-toggle="tab" style="font-size:18px;">Demografía</a></li>
                    <li class="tb"><a href="#tab-2" data-toggle="tab" style="font-size:18px;">Economía</a></li>
                    <li class="tb"><a href="#tab-3" data-toggle="tab" style="font-size:18px;">Salud</a></li>
                    <li class="tb"><a href="#tab-4" data-toggle="tab" style="font-size:18px;">Educación</a></li>
                    <li class="tb"><a href="#tab-5" data-toggle="tab" style="font-size:18px;">Ambiente</a></li>
                    <li class="tb"><a href="#tab-6" data-toggle="tab" style="font-size:18px;">Gestión Municipal</a></li>
                </ul>
            </div>
            <div style="margin-bottom: 20px;">
        			<table class="table" style="width:100%">
                <tbody>
        					<tr class="numbers">
                      <td class="color-indico"></td>
                      <td class="color-blue"></td>
                      <td class="color-orange"></td>
                  </tr>
                </tbody>
              </table>
        		</div>
          </div>
          <div class="panel-body">
            <div class="tab-content">
              <!--TERRITORY TAB-->
              <div class="tab-pane active" id="tab-0">

                <h2 id="title">Altitud de Territorios cubiertos por EPSUM (MSNM)</h2>
                <div class="row" style="padding-top:40px;padding-bottom:40px">
                  <div id="chartBox1" class="col-sm-12">
                    <canvas id="chart1" width="200" height="100"></canvas>
                  </div>
                </div>
                <h2 id="title">Territorios con mayor altitud (MSNM)</h2>
                <div class="row" style="padding-top:40px;padding-bottom:40px">
                  <div id="chartBox2" class="col-sm-12">
                    <canvas id="chart2" width="200" height="100"></canvas>
                  </div>
                </div>
                <h2 id="title">Territorios con menor altitud (MSNM)</h2>
                <div class="row" style="padding-top:40px;padding-bottom:40px">
                  <div id="chartBox3" class="col-sm-12">
                    <canvas id="chart3" width="200" height="100"></canvas>
                  </div>
                </div>
                <h2>Resumen de Territorios</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <tbody>
            					<tr class="numbers">
                          <td class="color-indico"></td>
                          <td class="color-orange"></td>
                      </tr>
                    </tbody>
                  </table>
            		</div>

                <div style="margin-bottom: 60px;">
                  <div>
                    <table class="table" style="width:100%">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Descripción de la ubicación</th>
                          <th style="text-align:right;">MSNM</th>
                          <th style="text-align:right;">Superficie (km2)</th>
                        </tr>
                      </thead>
                      <tbody class="content-1">
                        @foreach($territories as $t)

                        <tr>
                          <td>{{ $t->name }}</td>
                          <td>{{ $t->location }}</td>
                          <td style="text-align:right;">{{ number_format($t->masl) }} m</td>
                          <td style="text-align:right;">{{ number_format($t->surface) }}</td>
                        </tr>

                        @endforeach

                        <tr>
                          <td class="color-blue" style="font-size:16px;">Total</td>
                          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                          <td class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
              <!--DEMOGRAPHY TAB-->
              <div class="tab-pane" id="tab-1">

                <h2>Total Población general de territorios intervenidos</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Hombres</th>
                        <th>Mujeres</th>
                        <th> </th>
                        <th>Rural</th>
                        <th>Urbana</th>
                        <th>indígena</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr style="font-weight:bold;font-size:20px">
                          <td class="color-indico">{{ number_format($total_population[0]->pm) }} ({{ number_format($total_population[0]->pm * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                          <td class="color-blue">{{ number_format($total_population[0]->pw) }} ({{ number_format($total_population[0]->pw * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                          <td class="color-blue-2"></td>
                          <td class="color-orange">{{ number_format($total_population[0]->pr) }} ({{ number_format($total_population[0]->pr * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                          <td class="color-blue">{{ number_format($total_population[0]->pu) }} ({{ number_format($total_population[0]->pu * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                          <td class="color-red">{{ number_format($total_population[0]->pi) }} ({{ number_format($total_population[0]->pi * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div class="tableContainer">
                    <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <thead class="fixedHeader">
                        <tr>
                          <th width="16%">Territorio</th>
                          <th width="8%" style="text-align:right;">Hombres</th>
                          <th width="7%" style="text-align:right;">Mujeres</th>
                          <th width="8%" style="text-align:right;">Total</th>
                          <th width="6%" style="text-align:right;">% H</th>
                          <th width="6%" style="text-align:right;">% M</th>
                          <th width="8%" style="text-align:right;">Rural</th>
                          <th width="8%" style="text-align:right;">Urbana</th>
                          <th width="8%" style="text-align:right;">Indígena</th>
                          <th width="9%" style="text-align:right;">% Rur.</th>
                          <th width="10%" style="text-align:right;">% Urb.</th>
                          <th width="10%" style="text-align:right;">% Ind.</th>
                        </tr>
                      </thead>
                      <tbody class="scrollContent">
                        @foreach($population as $p)

                        <tr>
                          <td width="20%">{{ $p->territory }}</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pm) }}</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pw) }}</td>
                          <td width="10%" style="text-align:right;color:#333;font-weight:bold">{{ number_format($p->pm+$p->pw) }}</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pm*100/($p->pm+$p->pw),2) }}%</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pw*100/($p->pm+$p->pw),2) }}%</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pr) }}</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pu) }}</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pi) }}</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pr*100/($p->pm+$p->pw),2) }}%</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pu*100/($p->pm+$p->pw),2) }}%</td>
                          <td width="7%" style="text-align:right;">{{ number_format($p->pi*100/($p->pm+$p->pw),2) }}%</td>
                        </tr>

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="16%" class="color-blue" style="font-size:16px;">Total</td>
                        <td width="8%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pm) }}</td>
                        <td width="7%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pw) }}</td>
                        <td width="8%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pw+$total_population[0]->pm) }}</td>
                        <td width="6%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        <td width="6%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        <td width="8%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pr) }}</td>
                        <td width="8%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pu) }}</td>
                        <td width="8%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pi) }}</td>
                        <td width="9%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <h2 id="title-pop">Territorios con mayor Población Rural</h2>
                <div class="col-sm-12">
                  <div class="col-sm-4">
                    <label class="container chk-pop-1">Rural
                      <input type="radio" checked="checked" name="radioa">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-4">
                    <label class="container chk-pop-2">Urbana
                      <input type="radio" name="radioa">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-4">
                    <label class="container chk-pop-3">Indígena
                      <input type="radio" name="radioa">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
                <div class="row" style="padding-top:40px;padding-bottom:40px;min-height:500px">
                  <div id="chartBox4" class="col-sm-12">
                    <canvas id="chart4" width="200" height="100"></canvas>
                  </div>
                </div>


                <h2>Total Población por rango de edad</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Población territorios intervenidos</th>
                        <th>0 a 14 años de edad</th>
                        <th>15 a 64 años de edad</th>
                        <th>65 o más años de edad</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr style="font-weight:bold;font-size:20px">
                          <td class="color-indico">{{ number_format($total_population[0]->pm + $total_population[0]->pw) }} habitantes</td>
                          <td class="color-blue">{{ number_format($total_population_by_age[0]->p014) }} ({{ number_format($total_population_by_age[0]->p014 * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                          <td class="color-orange">{{ number_format($total_population_by_age[0]->p1564) }} ({{ number_format($total_population_by_age[0]->p1564 * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                          <td class="color-blue">{{ number_format($total_population_by_age[0]->p65) }} ({{ number_format($total_population_by_age[0]->p65 * 100 / ($total_population[0]->pm+$total_population[0]->pw)) }}%)</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div class="tableContainer">
                    <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <thead class="fixedHeader">
                        <tr>
                          <th width="20%">Territorio</th>
                          <th width="20%" style="text-align:right;">Población Total</th>
                          <th width="10%" style="text-align:right;">0 a 14 años de edad</th>
                          <th width="10%" style="text-align:right;">15 a 64 años de edad</th>
                          <th width="10%" style="text-align:right;">65 años o más</th>
                          <th width="10%" style="text-align:right;">% 0 a 14 años de edad</th>
                          <th width="10%" style="text-align:right;">% 15 a 64 años de edad</th>
                          <th width="10%" style="text-align:right;">% 65 o más años</th>
                        </tr>
                      </thead>
                      <tbody class="scrollContent">
                        @foreach($population_by_age as $p)

                        <tr>
                          <td width="20%">{{ $p->territory }}</td>
                          <td width="20%" style="text-align:right;color:#333;font-weight:bold">{{ number_format($p->pm+$p->pw) }}</td>
                          <td width="10%" style="text-align:right;">{{ number_format($p->p014) }}</td>
                          <td width="10%" style="text-align:right;">{{ number_format($p->p1564) }}</td>
                          <td width="10%" style="text-align:right;">{{ number_format($p->p65) }}</td>
                          <td width="10%" style="text-align:right;">{{ number_format($p->p014*100/($p->pm+$p->pw),2) }}%</td>
                          <td width="10%" style="text-align:right;">{{ number_format($p->p1564*100/($p->pm+$p->pw),2) }}%</td>
                          <td width="10%" style="text-align:right;">{{ number_format($p->p65*100/($p->pm+$p->pw),2) }}%</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td colspan="8"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="20%" class="color-blue" style="font-size:16px;">Total</td>
                        <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population[0]->pw+$total_population[0]->pm) }}</td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population_by_age[0]->p014) }}</td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population_by_age[0]->p1564) }}</td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_population_by_age[0]->p65) }}</td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        <td width="10%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
              <!--ECONOMY TAB-->
              <div class="tab-pane" id="tab-2">
                <h2 id="title-economy">Tasa de pobreza en territorios intervenidos</h2>
                <div class="col-sm-12" style="margin-top:20px;">
                  <div class="col-sm-2">
                    <label class="container chk-e-1" style="margin-left:0px">Pobreza
                      <input type="radio" checked="checked" name="radiob">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-3">
                    <label class="container chk-e-2" style="margin-left:0px;min-width:200px;">Pobreza Extrema
                      <input type="radio" name="radiob">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-2">
                    <label class="container chk-e-3" style="margin-left:0px">Ingreso
                      <input type="radio" name="radiob">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-1">
                    <h2 style="margin-top:0px;">|</h2>
                  </div>
                  <div class="col-sm-2">
                    <label class="container chk-e-asc" style="margin-left:0px">Ascendente
                      <input type="radio" name="radioc">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-2">
                    <label class="container chk-e-desc" style="margin-left:0px">Descendente
                      <input type="radio" checked="checked" name="radioc">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
                <div class="row" style="padding-top:40px;padding-bottom:40px;min-height:500px">
                  <div id="chartBox5" class="col-sm-12">
                    <canvas id="chart5" width="200" height="100"></canvas>
                  </div>
                </div>

                <h2>Calidad de Vida de la población</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Tasa promedio de pobreza</th>
                        <th>Tasa promedio de pobreza extrema</th>
                        <th>Promedio de ingreso por familia</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-blue">{{ number_format($total_economy[0]->poverty/$total_economy[0]->total) }}%</td>
                          <td class="color-orange">{{ number_format($total_economy[0]->poverty_extreme/$total_economy[0]->total) }}%</td>
                          <td class="color-blue">Q. {{ number_format($total_economy[0]->income/$total_economy[0]->total,2) }}</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="40%">Territorio</th>
                          <th width="20%" style="text-align:right;">% Pobreza</th>
                          <th width="20%" style="text-align:right;">% Pobreza extrema</th>
                          <th width="20%" style="text-align:right;">Ingreso por familia</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($economy as $e)

                        <tr>
                          <td width="40%">{{ $e->territory }}</td>
                          <td width="20%" style="text-align:right;">{{ number_format($e->poverty) }}%</td>
                          <td width="20%" style="text-align:right;">{{ number_format($e->poverty_extreme) }}%</td>
                          <td width="20%" style="text-align:right;">Q. {{ number_format($e->income,2) }}</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td width="40%" class="color-blue" style="font-size:16px;">Total</td>
                          <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                          <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                          <td width="20%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
              <!--HEALTH TAB-->
              <div class="tab-pane" id="tab-3">
                <h2>Resumen general de Salud en territorios intervenidos</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Tasa promedio de acceso de atención primaria en salud</th>
                        <th>Tasa promedio de enfermedades causadas por agua contaminada</th>
                        <th>Tasa promedio de desnutrición crónica</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-indico">{{ number_format($total_health[0]->rph/$total_health[0]->total) }}%</td>
                          <td class="color-blue">{{ number_format($total_health[0]->rdcw/$total_health[0]->total) }}%</td>
                          <td class="color-orange">{{ number_format($total_health[0]->rcm/$total_health[0]->total) }}%</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div class="tableContainer">
                    <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <thead class="fixedHeader">
                        <tr>
                          <th width="25%">Territorio</th>
                          <th width="25%" style="text-align:right;">Tasa de acceso a atención primaria en salud</th>
                          <th width="25%" style="text-align:right;">Tasa de enfermedades causadas por agua contaminada</th>
                          <th width="25%" style="text-align:right;">Tasa de desnutrición crónica</th>
                        </tr>
                      </thead>
                      <tbody class="scrollContent">
                        @foreach($health as $h)

                        <tr>
                          <td width="25%">{{ $h->territory }}</td>
                          <td width="25%" style="text-align:right;">{{ number_format($h->rph) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($h->rdcw) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($h->rcm) }}%</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td colspan="4"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="25%" class="color-blue" style="font-size:16px;">Promedio</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_health[0]->rph/$total_health[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_health[0]->rdcw/$total_health[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_health[0]->rcm/$total_health[0]->total) }}%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <h2 id="title-health">Tasa de accesso en atención primaria en salud</h2>
                <div class="col-sm-12" style="margin-top:20px;">
                  <div class="col-sm-2">
                    <label class="container chk-h-1" style="margin-left:0px">APS
                      <input type="radio" checked="checked" name="radiod">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-3">
                    <label class="container chk-h-2" style="margin-left:0px;">Enfermedades/agua contaminada
                      <input type="radio" name="radiod">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-2">
                    <label class="container chk-h-3" style="margin-left:0px">Desnutrición crónica
                      <input type="radio" name="radiod">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-1">
                    <h2 style="margin-top:0px;">|</h2>
                  </div>
                  <div class="col-sm-2">
                    <label class="container chk-h-asc" style="margin-left:0px">Ascendente
                      <input type="radio" name="radioe">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-2">
                    <label class="container chk-h-desc" style="margin-left:0px">Descendente
                      <input type="radio" checked="checked" name="radioe">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
                <div class="row" style="padding-top:40px;padding-bottom:40px;min-height:500px">
                  <div id="chartBox6" class="col-sm-12">
                    <canvas id="chart6" width="200" height="100"></canvas>
                  </div>
                </div>

                <h2>Enfermedades más frecuentes en niños menores de 5 años por territorio intervenido</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-blue"></td>
                          <td class="color-orange"></td>
                          <td class="color-blue"></td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="40%">Territorio</th>
                          <th width="60%">Enfermedades más frecuentes</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($health as $h)

                        <tr>
                          <td width="40%">{{ $h->territory }}</td>
                          <td width="60%">{{ $h->diseases }}</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td width="40%" class="color-blue" style="font-size:16px;">.</td>
                          <td width="60%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
              <!--EDUCATION TAB-->
              <div class="tab-pane table-responsive" id="tab-4">
                <h2>Tasa de aprobación de pruebas de matemática en territorios intervenidos</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Tasa promedio de aprobación en primaria</th>
                        <th>Tasa promedio de aprobación en secuendaria</th>
                        <th>Tasa promedio de aprobación en diversificado</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-indico">{{ number_format($total_education[0]->mp/$total_education[0]->total) }}%</td>
                          <td class="color-blue">{{ number_format($total_education[0]->ms/$total_education[0]->total) }}%</td>
                          <td class="color-orange">{{ number_format($total_education[0]->md/$total_education[0]->total) }}%</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div class="tableContainer">
                    <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <thead class="fixedHeader">
                        <tr>
                          <th width="25%">Territorio</th>
                          <th width="25%" style="text-align:right;">% aprobación puebas de matemática (Primaria)</th>
                          <th width="25%" style="text-align:right;">% aprobación puebas de matemática (Secundaria)</th>
                          <th width="25%" style="text-align:right;">% aprobación puebas de matemática (Diversificado)</th>
                        </tr>
                      </thead>
                      <tbody class="scrollContent">
                        @foreach($education as $e)

                        <tr>
                          <td width="20%">{{ $e->territory }}</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->mp) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->ms) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->md) }}%</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td colspan="4"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="20%" class="color-blue" style="font-size:16px;">Promedio</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_education[0]->mp/$total_education[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_education[0]->ms/$total_education[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_education[0]->md/$total_education[0]->total) }}%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <h2>Tasa de aprobación de pruebas de lectura en territorios intervenidos</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Tasa promedio de aprobación en primaria</th>
                        <th>Tasa promedio de aprobación en secuendaria</th>
                        <th>Tasa promedio de aprobación en diversificado</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-indico">{{ number_format($total_education[0]->rp/$total_education[0]->total) }}%</td>
                          <td class="color-blue">{{ number_format($total_education[0]->rs/$total_education[0]->total) }}%</td>
                          <td class="color-orange">{{ number_format($total_education[0]->rd/$total_education[0]->total) }}%</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div class="tableContainer">
                    <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <thead class="fixedHeader">
                        <tr>
                          <th width="25%">Territorio</th>
                          <th width="25%" style="text-align:right;">% aprobación puebas de lectura (Primaria)</th>
                          <th width="25%" style="text-align:right;">% aprobación puebas de lectura (Secundaria)</th>
                          <th width="25%" style="text-align:right;">% aprobación puebas de lectura (Diversificado)</th>
                        </tr>
                      </thead>
                      <tbody class="scrollContent">
                        @foreach($education as $e)

                        <tr>
                          <td width="20%">{{ $e->territory }}</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->rp) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->rs) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->rd) }}%</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td colspan="4"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="20%" class="color-blue" style="font-size:16px;">Promedio</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_education[0]->rp/$total_education[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_education[0]->rs/$total_education[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_education[0]->rd/$total_education[0]->total) }}%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
              <!--TERRITORY ENVIRONMENT-->
              <div class="tab-pane table-responsive" id="tab-5">
                <h2>Resumen general de Ambiente en territorios intervenidos</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                        <th>Tasa promedio de cobertura forestal</th>
                        <th>Tasa promedio de uso de la tierra para tareas agrícolas</th>
                        <th>Promedio de planes integrales para manejo de desechos sólidos</th>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-indico">{{ number_format($total_environment[0]->fcr/$total_environment[0]->total) }}%</td>
                          <td class="color-blue">{{ number_format($total_environment[0]->lur/$total_environment[0]->total) }}%</td>
                          <td class="color-orange">{{ number_format($total_environment[0]->npi/$total_environment[0]->total) }}</td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div class="tableContainer">
                    <table class="table scrollTable" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <thead class="fixedHeader">
                        <tr>
                          <th width="25%">Territorio</th>
                          <th width="25%" style="text-align:right;">% Cobertura forestal</th>
                          <th width="25%" style="text-align:right;">% Uso del suelo</th>
                          <th width="25%" style="text-align:right;">Número planes integrales para manejo de desechos sólidos</th>
                        </tr>
                      </thead>
                      <tbody class="scrollContent">
                        @foreach($environment as $e)

                        <tr>
                          <td width="20%">{{ $e->territory }}</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->fcr) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->lur) }}%</td>
                          <td width="25%" style="text-align:right;">{{ number_format($e->npi) }}</td>
                        </tr>

                        @endforeach
                        <tr>
                          <td colspan="4"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="20%" class="color-blue" style="font-size:16px;">Promedio</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_environment[0]->fcr/$total_environment[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_environment[0]->lur/$total_environment[0]->total) }}%</td>
                        <td width="25%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;">{{ number_format($total_environment[0]->npi/$total_environment[0]->total) }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
              <!--TERRITORY MUNICIPAL MANAGEMENT-->
              <div class="tab-pane" id="tab-6">
                <h2 id="title-health">Índice de Gestión Municipal en territorios intervenidos</h2>
                <div class="col-sm-12" style="margin-top:20px;">
                  <div class="col-sm-6">
                    <label class="container chk-mm-asc" style="margin-left:0px">Ascendente
                      <input type="radio" name="radiof">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-sm-6">
                    <label class="container chk-mm-desc" style="margin-left:0px">Descendente
                      <input type="radio" checked="checked" name="radiof">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
                <div class="row" style="padding-top:40px;padding-bottom:40px;min-height:500px">
                  <div id="chartBox7" class="col-sm-12">
                    <canvas id="chart7" width="200" height="100"></canvas>
                  </div>
                </div>

                <h2>Resumen Índice de gestión municipal</h2>
                <div style="margin-bottom: 20px;">
            			<table class="table" style="width:100%">
                    <thead>
            					<tr>
                      </tr>
                    </thead>
                    <tbody>
            					<tr class="numbers">
                          <td class="color-indico"></td>
                          <td class="color-blue"></td>
                          <td class="color-orange"></td>
                      </tr>
                    </tbody>
                  </table>
            		</div>
                <div style="margin-bottom: 60px;">
                  <div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="60%">Territorio</th>
                          <th width="40%" style="text-align:right;">Indice de gestión municipal</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($municipal_index as $mi)

                        <tr>
                          <td width="60%">{{ $mi->territory }}</td>
                          <td width="40%" style="text-align:right;">{{ number_format($mi->mmi,2) }}</td>
                        </tr>

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <table class="table">
                    <tbody >
                      <tr>
                        <td width="60%" class="color-blue" style="font-size:16px;">.</td>
                        <td width="40%" class="color-blue" style="text-align:right; font-weight:bold; font-size:16px;"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
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
      updateChartPopulation("pr");
      updateChartEconomy("poverty","desc");
      updateChartHealth("rph","desc");
      updateChartMunicipalIndex("desc");
  });

  $(".tb").click(function() {
    $('html,body').animate({
        scrollTop: $(".tabs").offset().top-60},'slow');
  });

  var economy_cat ="poverty";
  var economy_order = "desc";
  var health_cat ="rph";
  var health_order = "desc";

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
  });

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');
    }
  }, 500);

  // MASL TERRITORIES

  $.ajax({
		url: '{{asset("/stats/chart/dx/masl")}}',
		method: "GET",
		success: function(data) {
			console.log(data);
			var x= [""];
			var vals = [0];

      shuffle(data);

      for(var i in data) {
				x.push(data[i].name);
				vals.push(data[i].masl);
			}

			var chartdata = {
				labels: x,
				datasets : [
					{
						label: 'Territorio',
            backgroundColor: ["#2c89a033"],
            borderColor: ["#2c89a0"],
						data: vals
					}
				],
			};

			var ctx1 = document.getElementById('chart1').getContext('2d');

			chart_masl = new Chart(ctx1, {
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
                    return value+' m';
                  }
                }
              }]
            },

            /*tooltips: {
              mode: 'index',
              axis:'y',
              intersect: false,
              callbacks: {
              label: function(tooltipItem, data) {
                  return tooltipItem.yLabel;
                }
              }
            },*/
        },
			});
      console.log(data);
		},

		error: function(data) {
			console.log(data);
		}
	});

  // HG TERRITORIES

  $.ajax({
		url: '{{asset("/stats/chart/dx/masl/higher")}}',
		method: "GET",
		success: function(data) {
			console.log(data);
			var x= [""];
			var vals = [0];

      for(var i in data) {
				x.push(data[i].name);
				vals.push(data[i].masl);
			}

			var chartdata = {
				labels: x,
				datasets : [
					{
						label: 'Territorio',
            backgroundColor: ["#2c89a033"],
            borderColor: ["#2c89a0"],
						data: vals
					}
				],
			};

			var ctx2 = document.getElementById('chart2').getContext('2d');

			chart_masl = new Chart(ctx2, {
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
                    return value+' m';
                  }
                }
              }]
            },

            /*tooltips: {
              mode: 'index',
              axis:'y',
              intersect: false,
              callbacks: {
              label: function(tooltipItem, data) {
                  return tooltipItem.yLabel;
                }
              }
            },*/
        },
			});
      console.log(data);
		},

		error: function(data) {
			console.log(data);
		}
	});

  // LW TERRITORIES

  $.ajax({
		url: '{{asset("/stats/chart/dx/masl/lower")}}',
		method: "GET",
		success: function(data) {
			console.log(data);
			var x= [""];
			var vals = [0];

      for(var i in data) {
				x.push(data[i].name);
				vals.push(data[i].masl);
			}

			var chartdata = {
				labels: x,
				datasets : [
					{
						label: 'Territorio',
            backgroundColor: ["#2c89a033"],
            borderColor: ["#2c89a0"],
						data: vals
					}
				],
			};

			var ctx3 = document.getElementById('chart3').getContext('2d');

			chart_masl = new Chart(ctx3, {
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
                    return value+' m';
                  }
                }
              }]
            },

            /*tooltips: {
              mode: 'index',
              axis:'y',
              intersect: false,
              callbacks: {
              label: function(tooltipItem, data) {
                  return tooltipItem.yLabel;
                }
              }
            },*/
        },
			});
      console.log(data);
		},

		error: function(data) {
			console.log(data);
		}
	});

  // DEMOGRAPHY RURAL POPULATION
  function updateChartPopulation(category){
    $.ajax({
  		url: '{{asset("/stats/chart/dx/population/cat")}}'.replace('cat',category),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var x= [];
  			var vals = [];

        for(var i in data) {
          if(i!=0)
  				{x.push(data[i].territory);
          if(category == 'pr'){
            vals.push(data[i].pr);
          }else if(category == 'pu'){
            vals.push(data[i].pu);
          }else{
            vals.push(data[i].pi);
          }}
  			}

  			var chartdata = {
  				labels: x,
  				datasets : [
  					{
  						label: 'Población',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx4 = document.getElementById('chart4').getContext('2d');

  			chart_masl = new Chart(ctx4, {
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
                yAxes: [{
                  ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                      return value+' pers';
                    }
                  }
                }]
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


  // ECONOMY CHART
  function updateChartEconomy(category,order){
    $.ajax({
  		url: '{{asset("/stats/chart/dx/economy/cat/order")}}'.replace('cat/order',category+'/'+order),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var x= [];
  			var vals = [];

        for(var i in data) {
  				x.push(data[i].territory);
          if(category == 'poverty'){
            vals.push(data[i].poverty);
          }else if(category == 'poverty_extreme'){
            vals.push(data[i].poverty_extreme);
          }else{
            vals.push(data[i].income);
          }
  			}

  			var chartdata = {
  				labels: x,
  				datasets : [
  					{
  						label: 'Total',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx5 = document.getElementById('chart5').getContext('2d');

  			var chart_econ = new Chart(ctx5, {
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
                yAxes: [{
                  ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                      if(category == 'poverty'){return value+' %';}
                      else if(category == 'poverty_extreme'){return value+' %';}
                      else{return 'Q.'+value;}
                    }
                  }
                }]
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

  // HEARTH CHART
  function updateChartHealth(category,order){
    $.ajax({
  		url: '{{asset("/stats/chart/dx/health/cat/order")}}'.replace('cat/order',category+'/'+order),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var x= [];
  			var vals = [];

        for(var i in data) {
  				x.push(data[i].territory);
          if(category == 'rph'){
            vals.push(data[i].rph);
          }else if(category == 'rdcw'){
            vals.push(data[i].rdcw);
          }else{
            vals.push(data[i].rcm);
          }
  			}

  			var chartdata = {
  				labels: x,
  				datasets : [
  					{
  						label: 'Total',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx6 = document.getElementById('chart6').getContext('2d');

  			var chart_econ = new Chart(ctx6, {
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
                yAxes: [{
                  ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                      return value+' %';
                    }
                  }
                }]
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

  // MUNICIPAL MANAGEMENT CHART
  function updateChartMunicipalIndex(order){
    $.ajax({
  		url: '{{asset("/stats/chart/dx/municipalmanagement/order")}}'.replace('order',order),
  		method: "GET",
  		success: function(data) {
  			console.log(data);
  			var x= [];
  			var vals = [];

        for(var i in data) {
  				x.push(data[i].territory);
          if(data[i].mmi > 1){
            data[i].mmi = data[i].mmi/100;
          }

          vals.push(data[i].mmi);
  			}

  			var chartdata = {
  				labels: x,
  				datasets : [
  					{
  						label: 'Total',
              backgroundColor: gamma,
  						data: vals
  					}
  				],
  			};

  			var ctx7 = document.getElementById('chart7').getContext('2d');

  			var chart_econ = new Chart(ctx7, {
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
                yAxes: [{
                  ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                      return value.toFixed(2);
                    }
                  }
                }]
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


  // CHECKS POPULATION TYPE

  $(document).ready(function () {
      $('.chk-pop-1').click(function(){
          $('#chart4').remove();
          $('#chartBox4').append('<canvas id="chart4" width="200" height="100"></canvas>');
          $('#title-pop').html("Territorios con mayor población Rural");
          updateChartPopulation("pr");
      });

      $('.chk-pop-2').click(function(){
          $('#chart4').remove();
          $('#chartBox4').append('<canvas id="chart4" width="200" height="100"></canvas>');
          $('#title-pop').html("Territorios con mayor población Urbana");
          updateChartPopulation("pu");
      });

      $('.chk-pop-3').click(function(){
          $('#chart4').remove();
          $('#chartBox4').append('<canvas id="chart4" width="200" height="100"></canvas>');
          $('#title-pop').html("Territorios con mayor población indígena");
          updateChartPopulation("pi");
      });
  });

  // CHECKS ECONOMY

  $(document).ready(function () {
      $('.chk-e-1').click(function(){
          economy_cat = "poverty";
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          $('#title-economy').html("Tasa de pobreza en territorios intervenidos");
          updateChartEconomy(economy_cat,economy_order);
      });

      $('.chk-e-2').click(function(){
          economy_cat = "poverty_extreme";
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          $('#title-economy').html("Tasa de pobreza extrema en territorios intervenidos");
          updateChartEconomy(economy_cat,economy_order);
      });

      $('.chk-e-3').click(function(){
          economy_cat = "income";
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          $('#title-economy').html("Ingreso por familia de territorios intervenidos");
          updateChartEconomy(economy_cat,economy_order);
      });

      $('.chk-e-asc').click(function(){
          economy_order = "asc";
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          updateChartEconomy(economy_cat,economy_order);
      });

      $('.chk-e-desc').click(function(){
          economy_order = "desc";
          $('#chart5').remove();
          $('#chartBox5').append('<canvas id="chart5" width="200" height="100"></canvas>');
          updateChartEconomy(economy_cat,economy_order);
      });
  });

  // CHECKS HEALTH

  $(document).ready(function () {
      $('.chk-h-1').click(function(){
          health_cat = "rph";
          $('#chart6').remove();
          $('#chartBox6').append('<canvas id="chart6" width="200" height="100"></canvas>');
          $('#title-health').html("Tasa de atención primaria en salud");
          updateChartHealth(health_cat,health_order);
      });

      $('.chk-h-2').click(function(){
          health_cat = "rdcw";
          $('#chart6').remove();
          $('#chartBox6').append('<canvas id="chart6" width="200" height="100"></canvas>');
          $('#title-health').html("Tasa de enfermedades causadas por agua contaminada");
          updateChartHealth(health_cat,health_order);
      });

      $('.chk-h-3').click(function(){
          health_cat = "rcm";
          $('#chart6').remove();
          $('#chartBox6').append('<canvas id="chart6" width="200" height="100"></canvas>');
          $('#title-health').html("Tasa de desnutrición crónica en niños menores a 5 años");
          updateChartHealth(health_cat,health_order);
      });

      $('.chk-h-asc').click(function(){
          health_order = "asc";
          $('#chart6').remove();
          $('#chartBox6').append('<canvas id="chart6" width="200" height="100"></canvas>');
          updateChartHealth(health_cat,health_order);
      });

      $('.chk-h-desc').click(function(){
          health_order = "desc";
          $('#chart6').remove();
          $('#chartBox6').append('<canvas id="chart6" width="200" height="100"></canvas>');
          updateChartHealth(health_cat,health_order);
      });
  });

  // CHECKS MUNICIPAL MANAGEMENT

  $(document).ready(function () {

      $('.chk-mm-asc').click(function(){
          $('#chart7').remove();
          $('#chartBox7').append('<canvas id="chart7" width="200" height="100"></canvas>');
          updateChartMunicipalIndex("asc");
      });

      $('.chk-mm-desc').click(function(){
          $('#chart7').remove();
          $('#chartBox7').append('<canvas id="chart7" width="200" height="100"></canvas>');
          updateChartMunicipalIndex("desc");
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

  /* define height and width of scrollable area. Add 16px to width for scrollbar          */
  div.tableContainer {
  	clear: both;
  	height: 285px;
  	overflow: auto;
  }

  /* Reset overflow value to hidden for all non-IE browsers. */
  html>body div.tableContainer {
  	overflow: hidden;
  }

  /* define width of table. IE browsers only                 */
  div.tableContainer table {
  	float: left;
  	/* width: 740px */
  }

  /* define width of table. Add 16px to width for scrollbar.           */
  /* All other non-IE browsers.                                        */
  html>body div.tableContainer table {
  	/* width: 756px */
  }

  /* set table header to a fixed position. WinIE 6.x only                                       */
  /* In WinIE 6.x, any element with a position property set to relative and is a child of       */
  /* an element that has an overflow property set, the relative value translates into fixed.    */
  /* Ex: parent element DIV with a class of tableContainer has an overflow property set to auto */

  thead.fixedHeader tr {
  	position: relative;
  }

  html>body tbody.scrollContent {
  	display: block;
  	height: 250px;
  	overflow: auto;
  	width: 100%
  }

  html>body thead.fixedHeader {
  	display: table;
  	overflow: auto;
  	width: 100%
  }

  /* make TD elements pretty. Provide alternating classes for striping the table */
  /* http://www.alistapart.com/articles/zebratables/                             */
  tbody.scrollContent td, tbody.scrollContent tr.normalRow td {

  }

  tbody.scrollContent tr.alternateRow td {
  	background: #EEE;
  	border-bottom: none;
  	border-left: none;
  	border-right: 1px solid #CCC;
  	border-top: 1px solid #DDD;

  }
</style>

@endsection
