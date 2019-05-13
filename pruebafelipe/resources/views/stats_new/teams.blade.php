@extends('statstemplate')

@section('place')

  <div id="loader"></div>
  <div id="frame" class="row wrapper border-bottom white-bg page-heading" style="padding:60px; display:none">

    <h1>Reporte General de Equipos</h1>
		<h4>Programa del Ejercicio Profesional Supervisado Multidisciplinario</h4>

    <h5>Filtros de selección</h5>
    {!! Form::open(['class'=>'form-horizontal','method'=>'POST']) !!}
      
      <div id="filter" class="form-group">
        <div id="rfilter">
          <h3>Desea utilizar filtros</h3>
            <!-- <label class="radio-inline"><input type="radio" name="optradio"  class="option-input radio"checked>Mensual</label>
              <label class="radio-inline"><input type="radio" name="optradio" class="option-input radio">Cuatrimestre</label>-->
              <div class="cntr" style="align-items: center;">
                  <label for="rdof-1" class="btn-radio">
                  <input type="radio" id="rdof-1" name="radio-filter"  value="1" checked>
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Datos generales</span>
                  </label>
                  <label for="rdof-2" class="btn-radio">
                  <input type="radio" id="rdof-2" name="radio-filter" value="2">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Cohorte</span>
                  </label>
                  <label for="rdof-3" class="btn-radio">
                  <input type="radio" id="rdof-3" name="radio-filter" value="3">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Año</span>
                  </label>
                  <label for="rdof-4" class="btn-radio">
                  <input type="radio" id="rdof-4" name="radio-filter" value="4">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Sin restricción de cohorte o año</span>
                  </label>
              </div>
        </div>

      </div>
      <div id="timeDiv">  
        <div class="form-group"><label class="col-sm-2 control-label">Año</label>

          <div class="col-sm-10">
            {!!Form::select('yearsData',$yearsData,null,['id'=>'yearsData','class'=>'js-example-basic-single form-control m-b', 'placeholder' => 'Seleccione un año', 'required'=>'', 'style'=>'width:100%'])!!} 
          </div>

        </div>

        <div id="rTime" class="form-group">
          <h3>Periodo de conglomeración de datos</h3>
            <!-- <label class="radio-inline"><input type="radio" name="optradio"  class="option-input radio"checked>Mensual</label>
              <label class="radio-inline"><input type="radio" name="optradio" class="option-input radio">Cuatrimestre</label>-->
              <div class="cntr" style="align-items: center;">
                  <label for="rdo-1" class="btn-radio">
                  <input type="radio" id="rdo-1" name="radio-grp" value="1">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Mensual</span>
                  </label>
                  <label for="rdo-2" class="btn-radio">
                  <input type="radio" id="rdo-2" name="radio-grp" value="2">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Cuatrimestre</span>
                  </label>
                  <label for="rdo-3" class="btn-radio">
                  <input type="radio" id="rdo-3" name="radio-grp" value="3">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Semestre</span>
                  </label>
                  <label for="rdo-4" class="btn-radio">
                  <input type="radio" id="rdo-4" name="radio-grp" value="4">
                  <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <circle cx="10" cy="10" r="9"></circle>
                      <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                  </svg>
                  <span>Anual</span>
                  </label>
              </div>
        </div>

        <!-- Code for times of radios checked-->
          <div id="month">
            <div class="form-group"><label class="col-sm-2 control-label">Mes</label>
              <div class="col-sm-10">
                <select class="js-example-basic-single form-control m-b" id="smonth" style='width:100%'>
                  <option selected>Seleccione ...</option>
                  <option value="1">Enero</option>
                  <option value="2">Febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
            </div>
          </div>

          <div id="quarter">
            <div class="form-group"><label class="col-sm-2 control-label">Cuatrimestre</label>
              <div class="col-sm-10">
                <select class="js-example-basic-single form-control m-b" id="squater" style='width:100%'>
                  <option selected>Seleccione ...</option>
                  <option value="1">Primer cuatrimestre</option>
                  <option value="2">Segundo cuatrimestre</option>
                  <option value="3">Tercer cuatrimestre</option>
                </select>
              </div>
            </div>
          </div>

          <div id="semester" >
            <div class="form-group"><label class="col-sm-2 control-label">Semestre</label>
              <div class="col-sm-10">
                <select class="js-example-basic-single form-control m-b" id="ssemeter" style='width:100%'>
                  <option selected>Seleccione ...</option>
                  <option value="1">Primer semestre</option>
                  <option value="2">Segundo semestre</option>
                </select>
              </div>
            </div>
          </div>

          <div id="yearDiv" class="form-group"> AÑO: ¬|°</div>

      </div>

      <div id="chtDiv">
        <div class="form-group"><label class="col-sm-2 control-label">Cohorte</label>

          <div class="col-sm-10">
              {!!Form::select('gcohorts',$gcohorts,null,['id'=>'gcohorts','class'=>'js-example-basic-single form-control m-b', 'placeholder' => 'Seleccione una cohorte', 'required'=>'' , 'style'=>'width:100%'])!!} 
          </div>

        </div>    
      </div>
      
      <div id="subfilter">
      @if(Auth::user()!=null)
        @if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Supervisor" || Auth::user()->rol == "Admin" || Auth::user()->rol == "Gestor")
        <div class="form-group"><label class="col-sm-2 control-label">Supervisor</label>

          <div class="col-sm-10">
              {!!Form::select('supervisors',$supervisors,null,['id'=>'supervisors','class'=>'js-example-basic-single form-control m-b', 'placeholder' => 'Seleccione un supervisor', 'required'=>'', 'style'=>'width:100%'])!!} 
          </div>

        </div>
        @endif
      @endif  
        <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

          <div class="col-sm-10">
              {!!Form::select('departament',$departament,null,['id'=>'departament','class'=>'js-example-basic-single form-control m-b', 'placeholder' => 'Seleccione un departamento', 'required'=>'', 'style'=>'width:100%'])!!} 
          </div>

        </div>
     </div> 

          <div class="form-group">
            <label for="sel1">Lista de tipos de reportes:</label>
            <select class="js-example-basic-single form-control" id="sel1" style='width:100%'>
              <option selected>Seleccione ...</option>
              <option value="1">Resumen de Equipos</option>
              <option value="2">Equipos con mayor cantidad de asignaciones</option>
              <option value="3">Equipos por cohorte</option>
            </select>
          </div>

          <div class="box-footer">

              {!! Form::Submit('Seleccionar', ['id'=>'btnS','class'=>'btn btn-primary']) !!}
                       
          </div>
    {!! Form::close() !!}
    <h2> información </h2>
    <div class='centerdiv'>
          <button id="btn-dw-dx" type="button" class="btn btn-primary" style="float:right; margin-right:20px;">Descargar</button>
    </div>
    <div class='centerdiv'>
          <button id="btn-dw-grahp" type="button" class="btn btn-primary" style="float:right; margin-right:20px;">Descargar</button>
    </div>
    <div id="statsDiv"></div>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://codepen.io/anon/pen/aWapBE.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script type="text/javascript">

  var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };
  function resizePadding() {
    if(isMobile.any()) {
      jQuery("#frame").css("padding", "5px")
    }else{
      jQuery("#frame").css("padding", "60px")
    }
  }
  function convertObjectJSON(data) {
    var newData = '['+data+']';
    return JSON.parse(newData);
  }

  function deleteLastC(data) {
    return data.substr(0,data.length-1);
  }
  var languageData = '{"processing":"Cargando datos...","search": "Buscar","lengthMenu": "Mostrar _MENU_ datos","info": "Numero de páginas mostradas _PAGE_ of _PAGES_","infoEmpty":"No se encuentra datos disponibles","infoFiltered":"(Filtrado por _MAX_ total de datos)","loadingRecords": "Cargando datos...","zeroRecords":"No se encuentra información - Lo sentimos","emptyTable":"No se encuentra datos disponibles","paginate": {"first":"Primera","previous":"Anterior","next":"Siguiente","last":"Última"}}';
  var objLanguage = JSON.parse(languageData);

  function initTableUA() {
    var dataSet = convertObjectJSON(deleteLastC(jQuery('#dataUA').text()));
    console.log(dataSet);
    jQuery('#tableUA').html('');
    jQuery('<table/>',{
                        'class': 'table-striped table-hover display responsive no-wrap table table-striped table-hover dt-responsive display nowrap',
                        'cellspacing':'0',
                        'id': 'table_id',
                        'width': '100%'
                    }).appendTo('#tableUA');
    jQuery('#table_id').DataTable({ "lengthMenu": [[-1], ["Todos"]], responsive: true, "language": objLanguage,
        data: dataSet,
        columns: [
            { title: "Unidad Académica" },
            { title: "Hombres" },
            { title: "Mujeres" },
            { title: "Total" },
            { title: "% Hombres" },
            { title: "% Mujeres" },
            { title: "% de Total de Estudiantes" }
        ]
   });
  }

  var typeReport;
  function getReport(e) {
    e.preventDefault();
    //jQuery("#statsDiv").html('');
    jQuery("#statsDiv").show();
    typeReport = jQuery("#sel1").val();
    console.log("In gerReport : " + typeReport);
    if (filterRadio == 1) {
      //get report general
      if (typeReport == '0') {
        alert("Debe de seleccionar tipo de reporte que desea visualizar");
        hideReport();
      } else if(typeReport == '2'){
        
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsGraph")}}',
          type:"GET",
          dataType:"json",
          success:function(data){
            jQuery("#statsDiv").html('<h2 id="title">Equipos con mayor cantidad de asignaciones</h2> <div class="row" style="padding-top:40px;padding-bottom:40px"> <div id="chartBox4" class="col-sm-12"> <canvas id="chart4" width="200" height="75"></canvas> </div>  </div>');
            var x= [];
            var vals = [];
            var gamm = [];
            for(var i in data) {
              if(data[i].team.length > 15){
                data[i].team = data[i].team.substring(0,15)+"..."
              }
              x.push(data[i].team);
              vals.push(data[i].members);
              gamm.push(getRandomColor());
            }

            var chartdata = {
              labels: x,
              datasets : [
                {
                  label: 'Equipo',
                  backgroundColor: gamm,
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
                          return '' + value;
                        }
                      }
                    }],

                  }
              },
            });
          }
        });
       // jQuery('#btn-dw-grahp').show();
      }else {
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsGeneralTeams/typeReport")}}'.replace('typeReport',typeReport),
          type:"GET",
          dataType:"json",
          success:function(data){
            jQuery("#statsDiv").html(data['result']);
            jQuery.each(data, function(key, value) {
              //console.log("Key: "+key+" value: "+value);

              /*if (key.trim()=="supervisors") {
                jQuery.each(value, function(key1, value1){
                console.log("key1: "+key1+" value1: "+value1);
                });
              }*/
            
            });
            jQuery('#btn-dw-dx').show();
            full = jQuery('#statsDiv').html();
          }
        });
      }
      
    } else if (filterRadio == 2) {
      current_cohort = jQuery('select[name="gcohorts"] option:selected').text();
      supervisor = jQuery('#supervisors').val();
      departament = jQuery('#departament').val();
      console.log("cohorte:-"+current_cohort+"-\n Superv:-"+supervisor+"-\n depar:"+departament); 
      if (departament == '' || supervisor == '' || current_cohort == "Seleccione una cohorte" || typeReport == "0") {
        alert("Debe de seleccionar alguna opción en los filtros visualizados");
        hideReport();
      } else if(typeReport == '2'){
        
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsGraphByCohort/gcohorts/supervisors/departament")}}'.replace('gcohorts/supervisors/departament', current_cohort+'/'+supervisor+'/'+departament),
          type:"GET",
          dataType:"json",
          success:function(data){
            jQuery("#statsDiv").html('<h2 id="title">Equipos con mayor cantidad de asignaciones</h2> <div class="row" style="padding-top:40px;padding-bottom:40px"> <div id="chartBox4" class="col-sm-12"> <canvas id="chart4" width="200" height="75"></canvas> </div>  </div>');
            var x= [];
            var vals = [];
            var gamm = [];
            for(var i in data) {
              if(data[i].team.length > 15){
                data[i].team = data[i].team.substring(0,15)+"..."
              }
              x.push(data[i].team);
              vals.push(data[i].members);
              gamm.push(getRandomColor());
            }

            var chartdata = {
              labels: x,
              datasets : [
                {
                  label: 'Equipo',
                  backgroundColor: gamm,
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
                          return '' + value;
                        }
                      }
                    }],

                  }
              },
            });
          },error:function(){
            jQuery("#statsDiv").html('<h2> Error producido en el Servidor </h2>');
          }
        });
      
      } else {
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsTeamsFilters/typefilter/typeReport/gcohorts/supervisors/departament/yearsData/typeYears/dataYear")}}'.replace('typefilter/typeReport/gcohorts/supervisors/departament/yearsData/typeYears/dataYear', filterRadio+'/'+typeReport+'/'+current_cohort+'/'+supervisor+'/'+departament+'/createby/fsdb/34234'),
          type:"GET",
          dataType:"json",
          success:function(data){
            //console.log('console:'+data['result']);
            jQuery("#statsDiv").html(data['result']);
            jQuery('#btn-dw-dx').show();
            full = jQuery('#statsDiv').html();
          },error:function(){
            jQuery("#statsDiv").html('<h2> Error producido en el Servidor </h2>');
          }
        });
      }
    } else if (filterRadio == 3) {
      year_data = jQuery('select[name="yearsData"] option:selected').text();
      filterRadioY; //Periodo conglomeración
      if (filterRadioY == 1) {
        datayear = jQuery('#smonth').val();
      } else if (filterRadioY == 2) {
        datayear = jQuery('#squater').val();
      } else if (filterRadioY == 3) {
        datayear = jQuery('#ssemeter').val();
      } else if (filterRadioY == 4) {
        datayear = "0";
      }
      supervisor = jQuery('#supervisors').val();
      departament = jQuery('#departament').val();
      console.log("AÑO: "+year_data+" Per.Conglo: "+filterRadioY+" dato:"+datayear);
      if (departament == '' || supervisor == '' || year_data == "Seleccione una año" || datayear=='Seleccione ...' || filterRadioY=='' || typeReport == "0") {
        alert("Debe de seleccionar alguna opción en los filtros visualizados");
        hideReport();
      } else if(typeReport == '2'){
        
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsGraphByYear/yearsData/typeYears/dataYear/supervisors/departament")}}'.replace('yearsData/typeYears/dataYear/supervisors/departament', year_data+'/'+filterRadioY+'/'+datayear+'/'+supervisor+'/'+departament),
          type:"GET",
          dataType:"json",
          success:function(data){
            jQuery("#statsDiv").html('<h2 id="title">Equipos con mayor cantidad de asignaciones </h2> <div class="row" style="padding-top:40px;padding-bottom:40px"> <div id="chartBox4" class="col-sm-12"> <canvas id="chart4" width="200" height="75"></canvas> </div>  </div>');
            var x= [];
            var vals = [];
            var gamm = [];
            for(var i in data) {
              if(data[i].team.length > 15){
                data[i].team = data[i].team.substring(0,15)+"..."
              }
              x.push(data[i].team);
              vals.push(data[i].members);
              gamm.push(getRandomColor());
            }

            var chartdata = {
              labels: x,
              datasets : [
                {
                  label: 'Equipo',
                  backgroundColor: gamm,
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
                          return '' + value;
                        }
                      }
                    }],

                  }
              },
            });
          },error:function(){
            jQuery("#statsDiv").html('<h2> Error producido en el Servidor </h2>');
          }
        });
      
      }else {
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsTeamsFilters/typefilter/typeReport/gcohorts/supervisors/departament/yearsData/typeYears/dataYear")}}'.replace('typefilter/typeReport/gcohorts/supervisors/departament/yearsData/typeYears/dataYear', filterRadio+'/'+typeReport+'/filtercohort/'+supervisor+'/'+departament+'/'+year_data+'/'+filterRadioY+'/'+datayear),
          type:"GET",
          dataType:"json",
          success:function(data){
            //console.log('console:'+data['result']);
            jQuery("#statsDiv").html(data['result']);
            jQuery('#btn-dw-dx').show();
            full = jQuery('#statsDiv').html();
          },error:function(){
            jQuery("#statsDiv").html('<h2> Error producido en el Servidor </h2>');
          }
        });
      }
    } else if (filterRadio == 4){
      supervisor = jQuery('#supervisors').val();
      departament = jQuery('#departament').val();
      if (departament == '' || supervisor == '' ||  typeReport == "0") {
        alert("Debe de seleccionar alguna opción en los filtros visualizados");
        hideReport();
      } else if(typeReport == '2'){
        
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsGraphBySC/supervisors/departament")}}'.replace('supervisors/departament', supervisor+'/'+departament),
          type:"GET",
          dataType:"json",
          success:function(data){
            jQuery("#statsDiv").html('<h2 id="title">Equipos con mayor cantidad de asignaciones </h2> <div class="row" style="padding-top:40px;padding-bottom:40px"> <div id="chartBox4" class="col-sm-12"> <canvas id="chart4" width="200" height="75"></canvas> </div>  </div>');
            var x= [];
            var vals = [];
            var gamm = [];
            for(var i in data) {
              if(data[i].team.length > 15){
                data[i].team = data[i].team.substring(0,15)+"..."
              }
              x.push(data[i].team);
              vals.push(data[i].members);
              gamm.push(getRandomColor());
            }

            var chartdata = {
              labels: x,
              datasets : [
                {
                  label: 'Equipo',
                  backgroundColor: gamm,
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
                          return '' + value;
                        }
                      }
                    }],

                  }
              },
            });
          },error:function(){
            jQuery("#statsDiv").html('<h2> Error producido en el Servidor </h2>');
          }
        });
      
      } else {
        jQuery.ajax({
          url: '{{asset("stats/teams/getStatsTeamsFilters/typefilter/typeReport/gcohorts/supervisors/departament/yearsData/typeYears/dataYear")}}'.replace('typefilter/typeReport/gcohorts/supervisors/departament/yearsData/typeYears/dataYear', filterRadio+'/'+typeReport+'/currentCht/'+supervisor+'/'+departament+'/createby/fsdb/34234'),
          type:"GET",
          dataType:"json",
          success:function(data){
            //console.log('console:'+data['result']);
            jQuery("#statsDiv").html(data['result']);
            jQuery('#btn-dw-dx').show();
            full = jQuery('#statsDiv').html();
          },error:function(){
            jQuery("#statsDiv").html('<h2> Error producido en el Servidor </h2>');
          }
        });
      }
    
    }    
  }
 
	var current_cohort;
  var supervisor;
  var departament;		
  function hideReport() {
    jQuery("#statsDiv").hide();
    jQuery('#btn-dw-dx').hide();
    jQuery('#btn-dw-grahp').hide();
  }
  
  var filterRadio = jQuery("input:radio[name=radio-filter]").change().val();
  var filterRadioY = jQuery("input:radio[name=radio-grp]").change().val();

//Funciones de filtros iniciales
  function hidefilter() {
    jQuery("#timeDiv").hide();
    jQuery("#chtDiv").hide();
    jQuery("#subfilter").hide();
  }
  function showfiltercht() {
    jQuery("#chtDiv").show();
    jQuery("#subfilter").show();
  }
  function showfiltertime() {
    jQuery("#timeDiv").show();
    jQuery("#subfilter").show();
  }
  function showsubfilter() {
    jQuery("#subfilter").show();
  }

//Funciones de filtros de año
  function hidefilterY() {
    jQuery("#month").hide();
    jQuery("#quarter").hide();
    jQuery("#semester").hide();
    jQuery("#yearDiv").hide();
  }
  function showfilterM() {
    jQuery("#month").show();
  }
  function showfilterC() {
    jQuery("#quarter").show();
  }
  function showfilterS() {
    jQuery("#semester").show();
  }
  function showfilterY() {
    jQuery("#yearDiv").show();
  }

  var fecha = new Date();
  var ano = fecha.getFullYear();
  function writeyear(params) {
    var wyear = jQuery("#yearsData").val();
    jQuery("#yearDiv").html("");
    if (wyear == 0) {
      jQuery("#yearDiv").html("<h4>2017 - "+ano+"</h4>");
    } else {
      jQuery("#yearDiv").html("<h4>"+wyear+"</h4>");  
    }
  }

  function yaerP() {
    var va = jQuery("#yearsData").val();
    console.log("ingreso a año");
    console.log("Año: "+va);
    if (va != '') {
      jQuery("#rTime").show()
      writeyear();
    } else {
      jQuery("#rTime").hide();
      hidefilterY();
    }
  }
  jQuery(document).ready(function() {
    jQuery('#btn-dw-dx').hide();
    jQuery('#btn-dw-grahp').hide();
    hidefilter();
    jQuery("#rTime").hide()
    hidefilterY();
    jQuery("#yearsData").change(yaerP);
    jQuery("#btnS").click(getReport);
    jQuery("#sel1").change(hideReport);
    jQuery("input:radio[name=radio-filter]").change(function () {	 
			filterRadio=$(this).val();
      hideReport();
      console.log("Variable "+filterRadio);
      if (filterRadio == 1) {
        hidefilter();
      } else if (filterRadio == 2) {
        hidefilter();
        showfiltercht();
      } else if (filterRadio == 3) {
        hidefilter();
        showfiltertime();
      } else {
        hidefilter();
        showsubfilter();
      }
        
		});
    jQuery("input:radio[name=radio-grp]").change(function () {
      filterRadioY=$(this).val();
      hideReport();
      console.log("Filtros de año:"+filterRadioY);
      if (filterRadioY == 1) {
        hidefilterY();
        showfilterM();
      } else if (filterRadioY == 2) {
        hidefilterY();
        showfilterC();
      } else if (filterRadioY == 3) {
        hidefilterY();
        showfilterS();
      } else {
        hidefilterY();
        showfilterY();
        writeyear();
      }
    });

    
    console.log("Variable "+filterRadio);
    resizePadding();
    hideReport();
   // jQuery('#dataUA').hide();
    $("#btn-dw-grahp").click(function() { 
              html2canvas($("#statsDiv"), {
                  onrendered: function(canvas) {
                      theCanvas = canvas;
                      document.body.appendChild(canvas);
 
                     // canvas.toDataURL('/');
                      canvas.toBlob(function(blob) {
                        saveAs("/Dashboard.png"); 
                      });
                    
                  }
              });
    });
    $('#btn-dw-dx').click(function(){
                  
                  jQuery.ajax({
                      cache: false,
                      type: 'post',
                      url: '{{asset("get/report")}}',
    
                      data: {
                              '_token': '{{ csrf_token() }}',
                              'id': full
                          },
                      //xhrFields is what did the trick to read the blob to pdf
                      xhrFields: {
                          responseType: 'blob'
                      },
                      success: function (response, status, xhr) {
    
                          var filename = "";                   
                          var disposition = xhr.getResponseHeader('Content-Disposition');
    
                          if (disposition) {
                              var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                              var matches = filenameRegex.exec(disposition);
                              if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                          } 
                          var linkelem = document.createElement('a');
                          try {
                                                    var blob = new Blob([response], { type: 'application/octet-stream' });                        
    
                              if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                  //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                  window.navigator.msSaveBlob(blob, filename);
                              } else {
                                  var URL = window.URL || window.webkitURL;
                                  var downloadUrl = URL.createObjectURL(blob);
    
                                  if (filename) { 
                                      // use HTML5 a[download] attribute to specify filename
                                      var a = document.createElement("a");
    
                                      // safari doesn't support this yet
                                      if (typeof a.download === 'undefined') {
                                          window.location = downloadUrl;
                                      } else {
                                          a.href = downloadUrl;
                                          a.download = filename;
                                          document.body.appendChild(a);
                                          a.target = "_blank";
                                          a.click();
                                      }
                                  } else {
                                      window.location = downloadUrl;
                                  }
                              }   
    
                          } catch (ex) {
                              console.log(ex);
                          } 
                      }
                  });
                  swal({
                                  title: "Se ha descargado el reporte",
                                  text: "La información fue descargada como documento PDF",
                                  confirmButtonColor: "#2ebeef"
                  });        
    });
  });

  jQuery(window).resize(function(){
    resizePadding();
   });
   jQuery(document).ready(function() {
    resizePadding();
    jQuery('.js-example-basic-single').select2();
    jQuery('.js-example-basic-multiple').select2();
    
  });
  
  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
  var gamma = [ '#004455', '#2c89a0', '#69d2e7', '#aaccff', '#e0e4cc',
                '#ffb380', '#fa6900', '#ffcc00', '#ffe680', '#e9ddaf',
                '#ddff55', '#668000'];

  var interval = setInterval(function() {
    if(document.readyState === 'complete'){
      clearInterval(interval);
      console.log('DONE!');
      document.getElementById("loader").style.display = "none";
      $('#frame').fadeIn('slow');
    }
  }, 500);

  
  function loadingReportPDF(){
    document.getElementById("frame").style.opacity = 0.5;
    document.getElementById("loader-modal").style.display = "block";
    var interval = setInterval(function() {
      document.getElementById("frame").style.opacity = 1;
      document.getElementById("loader-modal").style.display = "none";
    }, 10000);
  }

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
  .centerdiv {
    display: flex;
    justify-content: center;
  }
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
    text-align: center;
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
    width: 100%;
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
    background: #f68628;
    color: #fff;
    font-size: 18px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
  }
  .select select::-ms-expand {
    display: none;
  }
  .select select:hover,
  .select select:focus {
    color: #fff;
    background: #02556e;
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
    border-color: #fff transparent transparent transparent;
  }
  .select select:hover ~ .select__arrow,
  .select select:focus ~ .select__arrow {
    border-top-color: #fff;
  }
  .select select:disabled ~ .select__arrow {
    border-top-color: #fff;
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

    /*for radio buttons*/
.cntr {
  margin: auto;
}

.btn-radio {
  cursor: pointer;
  display: inline-block;
  float: center;
  -webkit-user-select: none;
  user-select: none;
}
.btn-radio:not(:first-child) {
  margin-left: 20px;
}
@media screen and (max-width: 480px) {
  .btn-radio {
    display: block;
    float: none;
  }
  .btn-radio:not(:first-child) {
    margin-left: 0;
    margin-top: 15px;
  }
}
.btn-radio svg {
  fill: none;
  vertical-align: middle;
}
.btn-radio svg circle {
  stroke-width: 2;
  stroke: #C8CCD4;
}
.btn-radio svg path {
  stroke: #008FFF;
}
.btn-radio svg path.inner {
  stroke-width: 6;
  stroke-dasharray: 19;
  stroke-dashoffset: 19;
}
.btn-radio svg path.outer {
  stroke-width: 2;
  stroke-dasharray: 57;
  stroke-dashoffset: 57;
}
.btn-radio input {
  display: none;
}
.btn-radio input:checked + svg path {
  transition: all 0.4s ease;
}
.btn-radio input:checked + svg path.inner {
  stroke-dashoffset: 38;
  transition-delay: 0.3s;
}
.btn-radio input:checked + svg path.outer {
  stroke-dashoffset: 0;
}
.btn-radio span {
  display: inline-block;
  vertical-align: middle;
}
  </style>

@endsection
